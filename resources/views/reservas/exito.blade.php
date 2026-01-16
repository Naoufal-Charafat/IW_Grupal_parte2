@extends('layouts.public')

@section('content')
    {{-- Progress Steps - MANTENER AQUÍ (es parte del proceso de reserva, NO del header) --}}
    <x-reservation-steps :currentStep="4" />

    <!-- Main Content -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Success Icon and Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-green-100 rounded-full mb-6">
                <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">¡Cita Confirmada!</h1>
            <p class="text-lg text-gray-600">Tu cita ha sido reservada exitosamente</p>
        </div>

        <!-- Confirmation Number -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg px-6 py-6 mb-8 text-center">
            <p class="text-white text-sm font-medium mb-2">Número de Confirmación</p>
            <p class="text-white text-3xl font-bold tracking-wider">{{ $reserva->codigo_confirmacion }}</p>
        </div>

        <!-- Details de la cita -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!--Info del paciente-->
                <div>
                    <p class="text-sm text-gray-500 mb-1">Paciente</p>
                    @if($reserva->es_para_otro)
                        <p class="text-lg font-bold text-gray-900">{{ $reserva->nombre_paciente }}</p>
                        <p class="text-sm text-gray-600">{{ $reserva->email_paciente }}</p>
                        <p class="text-sm text-gray-600">{{ $reserva->telefono_paciente }}</p>
                        <span class="inline-block mt-2 px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Reserva para otra persona</span>
                    @else
                        <p class="text-lg font-bold text-gray-900">{{ $reserva->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $reserva->user->email }}</p>
                    @endif
                </div>

                <!-- Professional -->
                <div>
                    <p class="text-sm text-gray-500 mb-1">Profesional</p>
                    <p class="text-lg font-bold text-gray-900">{{ $reserva->profesional->user->name }}</p>
                    <p class="text-sm text-gray-600">{{ $reserva->tratamiento->nombre }}</p>
                </div>
            </div>

            <div class="border-t border-gray-200 my-6"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Date and Time -->
                <div>
                    <p class="text-sm text-gray-500 mb-1">Fecha y Hora</p>
                    <p class="text-lg font-bold text-gray-900">
                        {{ $reserva->fecha->format('d/m/Y') }}
                    </p>
                    <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($reserva->hora_inicio)->format('H:i') }}</p>
                </div>

                <!-- Duration -->
                <div>
                    <p class="text-sm text-gray-500 mb-1">Duración</p>
                    <p class="text-lg font-bold text-gray-900">{{ $reserva->duracion_minutos }} minutos</p>
                </div>
            </div>
        </div>

        <!-- Notas Adicionales (si existen) -->
        @if($reserva->notas)
        <div class="bg-blue-50 border border-blue-200 rounded-lg shadow-lg p-8 mb-6">
            <h3 class="text-lg font-bold text-blue-900 mb-3 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Notas Adicionales
            </h3>
            <p class="text-blue-800 whitespace-pre-line">{{ $reserva->notas }}</p>
        </div>
        @endif

        <!-- Important Information -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Información Importante</h3>
            <ul class="space-y-3">
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-700">Recibirás un email de confirmación en los próximos minutos</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-700">Por favor, llega 10 minutos antes de tu cita</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-700">Trae tu DNI o documento de identificación</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-gray-700">Si necesitas cancelar, hazlo con 24 horas de anticipación</span>
                </li>
            </ul>
        </div>

        <!-- Action Button -->
        <div class="text-center">
            <a href="/" 
               class="inline-flex items-center px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-semibold text-lg shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al Inicio
            </a>
        </div>
    </div>
@endsection
