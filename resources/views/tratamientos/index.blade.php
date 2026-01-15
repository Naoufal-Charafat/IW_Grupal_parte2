<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tratamientos - FisioClinic</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gray-50">
<x-header transparent="false"/>

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

<!-- Search and Filters Section -->
<div class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <form method="GET" action="{{ route('tratamientos.index') }}" class="space-y-4">
            <!-- Search Bar -->
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <label for="buscar" class="block text-sm font-medium text-gray-700 mb-2">
                        Buscar Tratamiento
                    </label>
                    <div class="relative">
                        <input
                                type="text"
                                name="buscar"
                                id="buscar"
                                value="{{ request('buscar') }}"
                                placeholder="Ej: Masaje, Rehabilitación..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                        >
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Precio Mínimo -->
                <div>
                    <label for="precio_min" class="block text-sm font-medium text-gray-700 mb-2">
                        Precio Mínimo (€)
                    </label>
                    <input
                            type="number"
                            name="precio_min"
                            id="precio_min"
                            value="{{ request('precio_min') }}"
                            min="0"
                            step="5"
                            placeholder="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                    >
                </div>

                <!-- Precio Máximo -->
                <div>
                    <label for="precio_max" class="block text-sm font-medium text-gray-700 mb-2">
                        Precio Máximo (€)
                    </label>
                    <input
                            type="number"
                            name="precio_max"
                            id="precio_max"
                            value="{{ request('precio_max') }}"
                            min="0"
                            step="5"
                            placeholder="100"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                    >
                </div>

                <!-- Duración Mínima -->
                <div>
                    <label for="duracion_min" class="block text-sm font-medium text-gray-700 mb-2">
                        Duración Mínima (min)
                    </label>
                    <input
                            type="number"
                            name="duracion_min"
                            id="duracion_min"
                            value="{{ request('duracion_min') }}"
                            min="0"
                            step="5"
                            placeholder="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                    >
                </div>

                <!-- Duración Máxima -->
                <div>
                    <label for="duracion_max" class="block text-sm font-medium text-gray-700 mb-2">
                        Duración Máxima (max)
                    </label>
                    <input
                            type="number"
                            name="duracion_max"
                            id="duracion_max"
                            value="{{ request('duracion_max') }}"
                            min="0"
                            step="5"
                            placeholder="120"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                    >
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                <button
                        type="submit"
                        class="inline-flex items-center justify-center px-6 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors"
                >
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Buscar
                </button>
                <a
                        href="{{ route('tratamientos.index') }}"
                        class="inline-flex items-center justify-center px-6 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors"
                >
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Limpiar Filtros
                </a>
            </div>

            <!-- Results Count -->
            @if(request()->hasAny(['buscar', 'precio_min', 'precio_max', 'duracion_min', 'duracion_max']))
                <div class="text-sm text-gray-600">
                    <span class="font-medium">{{ $tratamientos->count() }}</span> tratamiento(s) encontrado(s)
                </div>
            @endif
        </form>
    </div>
</div>

<!-- Treatments Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($tratamientos->isEmpty())
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No hay tratamientos disponibles</h3>
            <p class="mt-1 text-sm text-gray-500">
                @if(request()->hasAny(['buscar', 'precio_min', 'precio_max', 'duracion_min', 'duracion_max']))
                    No se encontraron tratamientos con los criterios seleccionados. Intenta con otros filtros.
                @else
                    Estamos actualizando nuestros servicios. Vuelve pronto.
                @endif
            </p>
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
                                <svg class="h-5 w-5 text-indigo-500 mr-3" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm font-medium">Duración: {{ $tratamiento->duracion_minutos }} minutos</span>
                            </div>

                            <div class="flex items-center text-gray-700">
                                <svg class="h-5 w-5 text-green-500 mr-3" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
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

        <!-- Pagination Links -->
        <div class="mt-8">
            {{ $tratamientos->links() }}
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

<x-footer/>
</body>
</html>
