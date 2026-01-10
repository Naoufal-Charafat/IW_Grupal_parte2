<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $tratamiento->nombre }} - FisioClinic</title>
    
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
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-md text-sm font-medium">
                        Registrarse
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumbs -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="/" class="text-gray-500 hover:text-gray-700">Inicio</a>
                    </li>
                    <li>
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </li>
                    <li>
                        <a href="{{ route('tratamientos.index') }}" class="text-gray-500 hover:text-gray-700">Tratamientos</a>
                    </li>
                    <li>
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </li>
                    <li>
                        <span class="text-gray-900 font-medium">{{ $tratamiento->nombre }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Treatment Details -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-8 py-12 text-white">
                <h1 class="text-4xl font-bold mb-4">
                    {{ $tratamiento->nombre }}
                </h1>
                <div class="flex items-center space-x-8">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-lg">{{ $tratamiento->duracion_minutos }} minutos</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <span class="text-2xl font-bold">{{ $tratamiento->rango_precio }}</span>
                            @if($tratamiento->hasPriceRange())
                                <p class="text-sm text-indigo-100 mt-1">Precio varía según profesional</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="px-8 py-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Descripción del Tratamiento</h2>
                <p class="text-gray-700 text-lg leading-relaxed">
                    {{ $tratamiento->descripcion }}
                </p>
            </div>

            <!-- Professionals Section -->
            @if($tratamiento->profesionales->isNotEmpty())
                <div class="px-8 py-8 bg-gray-50 border-t border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Profesionales Disponibles</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($tratamiento->profesionales as $profesional)
                            <div class="bg-white rounded-lg shadow p-6">
                                <div class="flex items-center mb-4">
                                    <div class="bg-indigo-100 rounded-full p-3">
                                        <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            {{ $profesional->user->name }}
                                        </h3>
                                        <p class="text-sm text-gray-500">Fisioterapeuta</p>
                                    </div>
                                </div>
                                @if($profesional->biografia)
                                    <p class="text-gray-600 text-sm">{{ Str::limit($profesional->biografia, 100) }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="px-8 py-8 bg-white border-t border-gray-200">
                <div class="flex flex-col sm:flex-row gap-4">
                    @auth
                        <a href="{{ route('reservas.select-profesional', $tratamiento) }}" 
                           class="flex-1 text-center bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition-colors duration-200 font-semibold">
                            Reservar Cita
                        </a>
                    @else
                        <a href="{{ route('login', ['redirect' => route('reservas.select-profesional', $tratamiento)]) }}" 
                           class="flex-1 text-center bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition-colors duration-200 font-semibold">
                            Iniciar Sesión para Reservar
                        </a>
                        <a href="{{ route('register') }}" 
                           class="flex-1 text-center bg-gray-200 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-300 transition-colors duration-200 font-semibold">
                            Crear Cuenta
                        </a>
                    @endauth
                    <a href="{{ route('tratamientos.index') }}" 
                       class="text-center bg-gray-100 text-gray-700 px-6 py-3 rounded-md hover:bg-gray-200 transition-colors duration-200 font-medium">
                        ← Volver a Tratamientos
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-blue-900">Información Importante</h3>
                    <div class="mt-2 text-sm text-blue-700 space-y-2">
                        <p>• Se recomienda llegar 10 minutos antes de su cita</p>
                        <p>• Traiga ropa cómoda apropiada para el tratamiento</p>
                        <p>• Para cancelaciones, avisar con al menos 24 horas de anticipación</p>
                        <p>• Consulte con su médico si tiene alguna condición médica especial</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p class="text-gray-400">
                    © {{ date('Y') }} FisioClinic. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
