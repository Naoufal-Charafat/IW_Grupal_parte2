<?php

namespace App\Http\Controllers;

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
        // CAMBIO 1: Usamos env() en lugar de config() para leer directo del .env
        // (O asegúrate de crear el archivo config/services.php)
        $this->apiKey = env('TPV_KEY');
        $this->baseUrl = env('TPV_URL');
    }

    /**
     * PASO A: Iniciar Pago
     */
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

        $amountFormatted = number_format($order->monto_total, 2, '.', '');
        $callbackUrl = url('/api/pagos/respuesta');

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
            // !!!!!!!!!!!!!!!!!
            // DEBUG
            return $response->json();

            $order->update(['payment_token' => $data['token']]);

            return redirect($data['paymentUrl']);
        }

//        dd([
//            'Estado HTTP' => $response->status(),
//            'Error del TPV' => $response->json(),
//            'Datos Enviados' => [
//                'url' => $this->baseUrl . '/api/v1/payments/init',
//                'amount' => $amountFormatted,
//                'callback' => $callbackUrl
//            ]
//        ]);
        Log::error('TPV Init Error:', $response->json());
        return back()->withErrors(['msg' => 'Error al conectar con la pasarela.']);
    }

    /**
     * PASO C: Retorno y Verificación
     */
    public function callback(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            abort(404, 'Token no encontrado');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get($this->baseUrl . "/api/v1/payments/verify/{$token}");

        if ($response->successful()) {
            $verificationData = $response->json();

            if ($verificationData['status'] === 'COMPLETED') {

                // CAMBIO 5: Usar el modelo Reserva, no Order (para evitar errores de clase)
                $order = Reserva::where('payment_token', $token)->first();

                // Añadimos chequeo de si existe la orden
                if ($order && $order->estado_pago !== 'pagado') { // Asumiendo que tu columna es estado_pago
                    $order->update([
                        'estado_pago' => 'pagado'
                    ]);

                    return view('tratamientos.show', $order->tratamiento_id);
                }
            } else {
                Log::warning("Pago fallido o incompleto para token: $token");
            }
        } else {
            Log::error('Error TPV Verify:', $response->json() ?? []);
        }

        return view('tratamientos.index');
    }
}