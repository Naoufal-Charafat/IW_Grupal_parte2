<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Tratamiento;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ContactoController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index(): View
    {
        // Obtener todos los tratamientos para el selector
        $tratamientos = Tratamiento::orderBy('nombre')->get();
        
        return view('contacto', compact('tratamientos'));
    }

    /**
     * Store a newly created contact message in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'servicio_interes' => ['nullable', 'string', 'max:255'],
            'mensaje' => ['required', 'string', 'min:10'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección válida.',
            'mensaje.required' => 'El mensaje es obligatorio.',
            'mensaje.min' => 'El mensaje debe tener al menos 10 caracteres.',
        ]);

        ContactMessage::create($validated);

        return response()->json([
            'success' => true,
            'message' => '¡Gracias por contactarnos! Responderemos tu mensaje en menos de 24 horas.',
        ]);
    }
}
