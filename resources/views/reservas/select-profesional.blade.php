@extends('layouts.public')

@section('content')
    <x-breadcrumbs :items="[
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Tratamientos', 'url' => route('tratamientos.index')],
        ['label' => $tratamiento->nombre, 'url' => route('tratamientos.show', $tratamiento)],
        ['label' => 'Seleccionar Profesional']
    ]" />

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">
                    Seleccionar Profesional
                </h1>
                <p class="mt-4 text-xl text-indigo-100">
                    Para: <span class="font-semibold">{{ $tratamiento->nombre }}</span>
                </p>
                <div class="mt-4 flex justify-center items-center space-x-6">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $tratamiento->duracion_minutos }} min</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xl font-bold">{{ number_format($tratamiento->precio, 2) }}€</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Instructions -->
        <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-blue-900">Primer Paso: Selecciona tu Profesional</h3>
                    <p class="mt-2 text-sm text-blue-700">
                        Elige el profesional de tu preferencia. Podrás ver su disponibilidad y seleccionar la fecha y hora en el siguiente paso.
                    </p>
                </div>
            </div>
        </div>

        <!-- Professionals Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($profesionales as $profesional)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-gradient-to-r from-indigo-500 to-blue-500 px-6 py-8 text-white text-center">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full mb-4">
                            <svg class="h-16 w-16 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold">
                            {{ $profesional->user->name }}
                        </h3>
                        <p class="text-indigo-100 mt-1">Fisioterapeuta Profesional</p>
                    </div>

                    <!-- Professional Details -->
                    <div class="px-6 py-6">
                        @if($profesional->numero_licencia)
                            <div class="flex items-center text-gray-600 mb-3">
                                <svg class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm">Licencia: {{ $profesional->numero_licencia }}</span>
                            </div>
                        @endif

                        @if($profesional->biografia)
                            <div class="mt-4">
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    {{ Str::limit($profesional->biografia, 150) }}
                                </p>
                            </div>
                        @endif

                        <!-- Pricing Information -->
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Precio del tratamiento:</span>
                                <span class="text-2xl font-bold text-indigo-600">
                                    @if($profesional->pivot->precio_personalizado)
                                        {{ number_format($profesional->pivot->precio_personalizado, 2) }}€
                                    @else
                                        {{ number_format($tratamiento->precio, 2) }}€
                                    @endif
                                </span>
                            </div>
                            @if($profesional->pivot->duracion_personalizada)
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-gray-600 text-sm">Duración:</span>
                                    <span class="text-gray-900 font-medium">
                                        {{ $profesional->pivot->duracion_personalizada }} min
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="px-6 pb-6">
                        <a href="{{ route('reservas.select-datetime', ['tratamiento' => $tratamiento, 'profesional' => $profesional]) }}" 
                           class="block w-full text-center bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition-colors duration-200 font-semibold">
                            Continuar con {{ explode(' ', $profesional->user->name)[0] }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Back Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('tratamientos.show', $tratamiento) }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-900 font-medium">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Volver al Tratamiento
            </a>
        </div>
    </div>
@endsection
