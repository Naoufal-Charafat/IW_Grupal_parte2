@props(['tratamiento'])

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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">Duración: {{ $tratamiento->duracion_minutos }}
                    minutos</span>
            </div>

            <div class="flex items-center text-gray-700">
                <svg class="h-5 w-5 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <span class="text-lg font-bold text-indigo-600">{{ $tratamiento->rango_precio }}</span>
                    @if($tratamiento->hasPriceRange())
                        <p class="text-xs text-gray-500 mt-0.5">Según profesional</p>
                    @endif
                </div>
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
