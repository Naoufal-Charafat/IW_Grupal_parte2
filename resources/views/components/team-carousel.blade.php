{{-- Team Carousel Component --}}

@php
    // Get first treatment to use with professional cards
    $tratamiento = \App\Models\Tratamiento::first();
    
    // Get professionals with their treatments
    $profesionales = \App\Models\Profesional::with(['user', 'tratamientos'])
        ->whereHas('tratamientos')
        ->limit(8)
        ->get();
@endphp

<section class="bg-gray-50 py-16">
    <div class="container">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Nuestro Equipo</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Profesionales certificados dedicados a tu salud y bienestar
            </p>
        </div>

        @if($profesionales->count() > 0 && $tratamiento)
            <div class="team-carousel-wrapper">
                <div class="team-carousel" id="teamCarousel">
                    <div class="team-carousel-track">
                        @foreach($profesionales as $profesional)
                            <div class="team-carousel-item">
                                <x-card-profesional 
                                    :profesional="$profesional" 
                                    :tratamiento="$tratamiento" 
                                />
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Carousel Controls --}}
                <div class="carousel-controls">
                    <button class="carousel-btn prev" id="teamPrev" aria-label="Previous">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="carousel-btn next" id="teamNext" aria-label="Next">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500">No hay profesionales disponibles en este momento.</p>
            </div>
        @endif
    </div>
</section>

{{-- Include Team Carousel Styles --}}
<link rel="stylesheet" href="{{ asset('css/team-carousel.css') }}">

{{-- Include Team Carousel Script --}}
<script src="{{ asset('js/team-carousel.js') }}" defer></script>
