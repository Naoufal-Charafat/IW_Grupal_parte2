@props(['profesional', 'tratamiento'])

<div class="bg-white rounded-lg shadow hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
    <!-- Professional Header -->
    <div class="bg-gradient-to-r from-indigo-500 to-blue-500 px-6 py-4">
        <div class="flex items-center">
            <div class="bg-white rounded-full p-3">
                <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-bold text-white">{{ $profesional->user->name }}</h3>
            </div>
        </div>
    </div>

    <!-- Professional Body -->
    <div class="px-6 py-4">
        @if ($profesional->biografia)
            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                {{ Str::limit($profesional->biografia, 120) }}
            </p>
        @endif

        <!-- Precio y Duración -->
        <div class="border-t border-gray-200 pt-4 mt-4">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-600">Duración:</span>
                <span
                    class="font-semibold text-gray-900">{{ $profesional->pivot->duracion_personalizada ?? $tratamiento->duracion_minutos }}
                    min</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Precio:</span>
                <span
                    class="text-xl font-bold text-indigo-600">{{ number_format($profesional->pivot->precio_personalizado ?? $tratamiento->precio, 2) }}€</span>
            </div>
        </div>
    </div>

    <!-- Action Footer -->
    <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
        <a href="@auth{{ route('reservas.select-datetime', ['tratamiento' => $tratamiento, 'profesional' => $profesional]) }}@else{{ route('login', ['redirect' => route('reservas.select-datetime', ['tratamiento' => $tratamiento, 'profesional' => $profesional])]) }} @endauth"
            class="block w-full text-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors duration-200 font-medium">
            Seleccionar Profesional
        </a>
    </div>
</div>
