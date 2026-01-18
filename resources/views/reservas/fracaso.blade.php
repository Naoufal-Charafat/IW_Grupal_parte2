<x-app-layout>
    {{-- Progress Steps - Mantenemos el paso 4 pero visualmente indicará el final del proceso --}}
    <x-reservation-steps :currentStep="4" />

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-red-100 rounded-full mb-6">
                <svg class="w-16 h-16 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">¡Algo salió mal!</h1>
            <p class="text-lg text-gray-600">No hemos podido completar tu reserva</p>
        </div>

        <div class="bg-red-50 border-l-4 border-red-500 p-6 mb-8 shadow-md rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-red-800">Detalles del error</h3>
                    <div class="mt-2 text-red-700">
                        <p>
                            {{-- Aquí mostramos el mensaje de error si viene en la sesión, si no, uno genérico --}}
                            {{ session('error') ?? 'Hubo un problema procesando el pago o confirmando la disponibilidad.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg border border-gray-200 p-8 mb-6 opacity-75">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Servicio Solicitado</p>
                    {{-- Usamos optional() por si el objeto reserva no se cargó bien --}}
                    <p class="text-lg font-bold text-gray-800">{{ optional($reserva->tratamiento)->nombre ?? 'Tratamiento' }}</p>
                    <p class="text-sm text-gray-600">{{ optional(optional($reserva->profesional)->user)->name ?? 'Profesional' }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-1">Fecha Intentada</p>
                    @if(isset($reserva->fecha))
                        <p class="text-lg font-bold text-gray-800">
                            {{ $reserva->fecha->format('d/m/Y') }}
                        </p>
                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($reserva->hora_inicio)->format('H:i') }}</p>
                    @else
                        <p class="text-gray-600">Fecha no disponible</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">¿Qué puedes hacer ahora?</h3>
            <ul class="space-y-3">
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-indigo-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <span class="text-gray-700">Verifica que tu tarjeta tenga fondos suficientes y esté habilitada para compras online.</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-indigo-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-gray-700">La hora seleccionada sigue bloqueada temporalmente para ti. Puedes reintentarlo.</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-indigo-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span class="text-gray-700">Si el problema persiste, contacta con soporte técnico.</span>
                </li>
            </ul>
        </div>

        <div class="flex flex-col sm:flex-row justify-center gap-4">

            {{-- Botón para reintentar el pago (Redirige a la función de pagar de nuevo) --}}
            @if(isset($reserva->id))
                <a href="{{ route('payment.initiate', ['id' => $reserva->id]) }}"
                   class="inline-flex items-center justify-center px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-semibold text-lg shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Reintentar Pago
                </a>
            @endif

            <a href="/"
               class="inline-flex items-center justify-center px-8 py-3 bg-white text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors font-semibold text-lg shadow-sm">
                Volver al Inicio
            </a>
        </div>
    </div>
</x-app-layout>