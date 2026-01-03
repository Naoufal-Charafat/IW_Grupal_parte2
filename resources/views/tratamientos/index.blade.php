<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tratamientos - FisioClinic</title>
    
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
                    <a href="{{ route('tratamientos.index') }}" class="text-indigo-600 border-b-2 border-indigo-600 px-3 py-2 text-sm font-medium">
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

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl md:text-6xl">
                    Nuestros Tratamientos
                </h1>
                <p class="mt-6 text-xl text-indigo-100 max-w-3xl mx-auto">
                    Servicios profesionales de fisioterapia adaptados a tus necesidades. 
                    Recuperación, bienestar y salud en manos de expertos.
                </p>
            </div>
        </div>
    </div>

    <!-- Treatments Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($tratamientos->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay tratamientos disponibles</h3>
                <p class="mt-1 text-sm text-gray-500">Estamos actualizando nuestros servicios. Vuelve pronto.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($tratamientos as $tratamiento)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <!-- Treatment Header -->
                        <div class="bg-gradient-to-r from-indigo-500 to-blue-500 px-6 py-4">
                            <h3 class="text-xl font-bold text-white">
                                {{ $tratamiento->nombre }}
                            </h3>
                        </div>
                        
                        <!-- Treatment Body -->
                        <div class="px-6 py-4">
                            <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                {{ $tratamiento->descripcion }}
                            </p>
                            
                            <!-- Treatment Details -->
                            <div class="space-y-3">
                                <div class="flex items-center text-gray-700">
                                    <svg class="h-5 w-5 text-indigo-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm font-medium">Duración: {{ $tratamiento->duracion_minutos }} minutos</span>
                                </div>
                                
                                <div class="flex items-center text-gray-700">
                                    <svg class="h-5 w-5 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-lg font-bold text-indigo-600">{{ number_format($tratamiento->precio, 2) }}€</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Treatment Footer -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                            <a href="{{ route('tratamientos.show', $tratamiento) }}" 
                               class="block w-full text-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors duration-200 font-medium">
                                Ver Detalles
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Call to Action -->
    <div class="bg-indigo-700 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white mb-4">
                    ¿Listo para comenzar tu tratamiento?
                </h2>
                <p class="text-xl text-indigo-100 mb-8">
                    Reserva tu cita y comienza tu camino hacia el bienestar
                </p>
                @guest
                    <div class="space-x-4">
                        <a href="{{ route('register') }}" 
                           class="inline-block bg-white text-indigo-700 px-8 py-3 rounded-md hover:bg-gray-100 transition-colors duration-200 font-semibold">
                            Crear Cuenta
                        </a>
                        <a href="{{ route('login') }}" 
                           class="inline-block bg-indigo-500 text-white px-8 py-3 rounded-md hover:bg-indigo-600 transition-colors duration-200 font-semibold">
                            Iniciar Sesión
                        </a>
                    </div>
                @else
                    <a href="{{ url('/dashboard') }}" 
                       class="inline-block bg-white text-indigo-700 px-8 py-3 rounded-md hover:bg-gray-100 transition-colors duration-200 font-semibold">
                        Ir al Dashboard
                    </a>
                @endguest
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
