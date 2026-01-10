<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cita Confirmada - FisioClinic</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gradient-to-br from-green-50 to-blue-50 min-h-screen">
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
                
                <div class="w-16 h-0.5 bg-green-500"></div>
                
                <!-- Step 3 -->
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-green-500 text-white">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-900">Confirmar</span>
                </div>
            </div>
        </div>
    </div>

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

        <!-- Appointment Details -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Professional -->
                <div>
                    <p class="text-sm text-gray-500 mb-1">Profesional</p>
                    <p class="text-lg font-bold text-gray-900">{{ $reserva->profesional->user->name }}</p>
                    <p class="text-sm text-gray-600">{{ $reserva->tratamiento->nombre }}</p>
                </div>

                <!-- Date and Time -->
                <div>
                    <p class="text-sm text-gray-500 mb-1">Fecha y Hora</p>
                    <p class="text-lg font-bold text-gray-900">
                        {{ $reserva->fecha_hora->format('d/m/Y') }}
                    </p>
                    <p class="text-sm text-gray-600">{{ $reserva->fecha_hora->format('H:i') }}</p>
                </div>
            </div>
        </div>

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
</body>
</html>
