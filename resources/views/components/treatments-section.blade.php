{{-- Treatments Section Component --}}
@props(['limit' => 4])

@php
    $tratamientos = \App\Models\Tratamiento::orderBy('created_at', 'desc')
        ->limit($limit)
        ->get();
@endphp

<section class="bg-white py-16">
    <div class="container">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Nuestros Tratamientos</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Descubre nuestra amplia gama de tratamientos diseñados para tu bienestar
            </p>
        </div>

        @if($tratamientos->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($tratamientos as $tratamiento)
                    <x-card-tratamiento :tratamiento="$tratamiento" />
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('tratamientos.index') }}" 
                   class="inline-flex items-center justify-center px-8 py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition-colors duration-200">
                    Ver Todos los Tratamientos
                    <svg class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500">No hay tratamientos disponibles en este momento.</p>
            </div>
        @endif
    </div>
</section>
