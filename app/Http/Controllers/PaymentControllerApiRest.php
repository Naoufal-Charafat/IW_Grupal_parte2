<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reserva; // Usamos Reserva consistentemente
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentControllerApiRest extends Controller
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('TPV_KEY');
        $this->baseUrl = env('TPV_URL');
    }

    public function initiate(Request $request)
    {
        // 1. Obtener ID
        $id = $request->query('id');
        if (!$id) {
            return response()->json(['error' => 'ID es requerido'], 400);
        }

        $order = Reserva::findOrFail($id);

        if (empty($this->baseUrl) || empty($this->apiKey)) {
            dd('Error de config', [
                'Url' => $this->baseUrl,
                'Key' => $this->apiKey
            ]);
        }
        $hotel = Hotel::where('user_id', $order->user_id)->first();
        if ($hotel) {
            $order->monto_total += $order->monto_total * 0.05;
        }
        $amountFormatted = number_format($order->monto_total, 2, '.', '');
        $callbackUrl = route('payment.callback');
        // 4. Llamada a la API
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ])->post($this->baseUrl . 'api/v1/payments/init', [
            'amount'      => $amountFormatted,
            'callbackUrl' => $callbackUrl,
        ]);

        // 5. Manejo de Respuesta
        if ($response->successful()) {
            $data = $response->json();

            $order->update(['payment_token' => $data['token']]);

            return redirect($data['paymentUrl']);
        }

        Log::error('TPV Init Error:', $response->json());
        return redirect()->route('reservas.fracaso', ['reserva' => $order->id]);
    }

    public function callback(Request $request)
    {
        $token = $request->query('token');
        if (!$token) {
            abort(404, 'Token no encontrado en la URL');
        }

        $response = Http::withHeaders([
            'X-API-KEY'    => $this->apiKey,
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ])->get($this->baseUrl . "api/v1/payments/verify/{$token}");

        $order = Reserva::where('payment_token', $token)->first();
        if ($response->successful()) {
            $verificationData = $response->json();

            // Verificamos estado
            if (isset($verificationData['status']) && $verificationData['status'] === 'COMPLETED') {

                if ($order) {
                    // Actualizar estado
                    $hotel = Hotel::where('user_id', $order->user_id)->first();
                    if ($hotel) {
                        $commission = $order->monto_total * 0.05;
                        $hotel->increment('total_ref_amount', $commission);
                    }
                    $order->update(['estado_pago' => 'pagado']);

                    // 3. Redirección final
                    return redirect()->route('reservas.exito', ['reserva' => $order->id]);
                }
            }
        }
        $order->update(['estado_pago' => 'fallido']);
        Log::error('Fallo en callback TPV', ['response' => $response->body()]);
        return redirect()->route('reservas.exito', ['reserva' => $order->id]);
    }

    public function refund(Request $request)
    {
        $id = $request->query('id');
        if (!$id) {
            abort(404, 'Id no encontrado en la URL');
        }

        $order = Reserva::findOrFail($id);
        if ($order->estado_pago !== 'pagado') {
            return back()->with('error', 'Esta reserva no se puede reembolsar porque no está pagada.');
        }
        $amount = $order->monto_total;

        $hotel = Hotel::where('user_id', $order->user_id)->first();
        if ($hotel) {
            $amount += $order->monto_total * 0.05;
        }

        $response = Http::withHeaders([
            'X-API-KEY'    => $this->apiKey,
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ])->post($this->baseUrl . 'api/v1/refunds/external', [
            'transactionToken' => $order->payment_token,
            'amount' => $amount
        ]);

        if ($response->successful()) {
            $verificationData = $response->json();

            // Verificamos estado
            if (isset($verificationData['status']) && $verificationData['status'] === 'COMPLETED') {

                if ($order) {

                    if ($hotel) {
                        $commission = $order->monto_total * 0.05;
                        $hotel->decrement('total_ref_amount', $commission);
                    }
                    $order->update(['estado_pago' => 'reembolsado']);

                    // 3. Redirección final
                    return redirect()->route('dashboard');
                }
            }
        }
        $order->update(['estado_pago' => 'fallido']);
        Log::error('Fallo en callback TPV', ['response' => $response->body()]);
        return redirect()->route('dashboard');
    }
}