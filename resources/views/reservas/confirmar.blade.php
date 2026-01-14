<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Confirmar Reserva - FisioClinic</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-2xl font-bold text-indigo-600">
                        🏥 FisioClinic
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:space-x-8">
                    <a href="/" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">
                        Inicio
                    </a>
                    <a href="{{ route('tratamientos.index') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">
                        Tratamientos
                    </a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <span class="text-gray-600 px-3 py-2 text-sm font-medium">
                            {{ auth()->user()->name }}
                        </span>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Progress Steps -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-center space-x-4">
                <!-- Step 1 -->
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-green-500 text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-500">Elegir Profesional</span>
                </div>
                
                <div class="w-16 h-0.5 bg-green-500"></div>
                
                <!-- Step 2 -->
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-green-500 text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-500">Fecha y Hora</span>
                </div>
                
                <div class="w-16 h-0.5 bg-indigo-600"></div>
                
                <!-- Step 3 -->
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-600 text-white font-semibold">
                        3
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-900">Confirmar</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Back Button -->
        <a href="javascript:history.back()" 
           class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver a fecha y hora
        </a>

        <!-- Title -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Resumen de tu cita</h1>
            <p class="text-gray-600">Revisa los detalles antes de confirmar</p>
        </div>

        <!-- Appointment Details Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Detalles de la Cita</h2>
                <p class="text-indigo-100 text-sm">Por favor, verifica toda la información</p>
            </div>

            <!-- Card Body -->
            <div class="px-6 py-6 space-y-6">
                <!-- Patient Info -->
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500 mb-1">Paciente</p>
                        @if($es_para_otro)
                            <p class="text-lg font-bold text-gray-900">{{ $nombre_paciente }}</p>
                            <p class="text-sm text-gray-600">{{ $email_paciente }}</p>
                            <p class="text-sm text-gray-600">{{ $telefono_paciente }}</p>
                            <span class="inline-block mt-1 px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Reserva para otra persona</span>
                        @else
                            <p class="text-lg font-bold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                        @endif
                    </div>
                </div>

                <div class="border-t border-gray-200"></div>

                <!-- Professional -->
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500 mb-1">Profesional</p>
                        <p class="text-lg font-bold text-gray-900">{{ $profesional->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $tratamiento->nombre }}</p>
                    </div>
                </div>

                <div class="border-t border-gray-200"></div>

                <!-- Date -->
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500 mb-1">Fecha</p>
                        <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</p>
                    </div>
                </div>

                <div class="border-t border-gray-200"></div>

                <!-- Time -->
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500 mb-1">Hora</p>
                        <p class="text-lg font-bold text-gray-900">{{ $hora }}</p>
                    </div>
                </div>

                <div class="border-t border-gray-200"></div>

                <!-- Duration -->
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500 mb-1">Duración</p>
                        <p class="text-lg font-bold text-gray-900">{{ $duracion }} minutos</p>
                    </div>
                </div>

                <div class="border-t border-gray-200"></div>

                <!-- Price -->
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500 mb-1">Precio Final</p>
                        <p class="text-2xl font-bold text-indigo-600">{{ number_format($precio, 2) }}€</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Important Notice -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-r-lg mb-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-bold text-yellow-800 mb-2">Importante</h3>
                    <p class="text-sm text-yellow-700">
                        Por favor, llega 10 minutos antes de tu cita. Si necesitas cancelar, hazlo con al menos 24 horas de anticipación.
                    </p>
                </div>
            </div>
        </div>

        <!-- Notas Adicionales -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Notas Adicionales (Opcional)</h3>
            <p class="text-sm text-gray-600 mb-4">¿Tienes alguna información adicional que quieras compartir con el profesional?</p>
            <form id="reservation-form" method="POST" action="{{ route('reservas.store') }}">
                @csrf
                <input type="hidden" name="tratamiento_id" value="{{ $tratamiento->id }}">
                <input type="hidden" name="profesional_id" value="{{ $profesional->id }}">
                <input type="hidden" name="fecha" value="{{ $fecha }}">
                <input type="hidden" name="hora" value="{{ $hora }}">
                
                @if($es_para_otro)
                    <input type="hidden" name="es_para_otro" value="1">
                    <input type="hidden" name="nombre_paciente" value="{{ $nombre_paciente }}">
                    <input type="hidden" name="email_paciente" value="{{ $email_paciente }}">
                    <input type="hidden" name="telefono_paciente" value="{{ $telefono_paciente }}">
                @endif
                
                <textarea name="notas" 
                          rows="4" 
                          class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors resize-none"
                          placeholder="Ej: Primera consulta, lesión previa, alergias, preferencias de tratamiento..."></textarea>
            </form>
        </div>

        <!-- Action Buttons -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <button onclick="window.history.back()"
                    class="w-full px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-semibold text-lg">
                Cancelar
            </button>
            <button type="submit"
                    form="reservation-form"
                    class="w-full px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-semibold text-lg flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Confirmar Cita
            </button>
        </div>
    </div>
</body>
</html>
