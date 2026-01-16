{{-- Hero Carousel Component with Video Background --}}

<div class="hero-carousel" id="heroCarousel">
    {{-- Video Slides --}}
    <div class="carousel-slide active">
        <video autoplay muted loop playsinline class="carousel-video">
            <source src="{{ asset('videos/00.mp4') }}" type="video/mp4">
        </video>
        <div class="carousel-overlay">
            <div class="carousel-content">
                <h1 class="hero-title">Bienvenido a FisioClinic</h1>
                <p class="hero-subtitle">Tu salud es nuestra prioridad</p>
            </div>
        </div>
    </div>

    <div class="carousel-slide">
        <video muted loop playsinline class="carousel-video">
            <source src="{{ asset('videos/01.mp4') }}" type="video/mp4">
        </video>
        <div class="carousel-overlay">
            <div class="carousel-content">
                <h1 class="hero-title">Profesionales Certificados</h1>
                <p class="hero-subtitle">Más de 10 años de experiencia</p>
            </div>
        </div>
    </div>

    <div class="carousel-slide">
        <video muted loop playsinline class="carousel-video">
            <source src="{{ asset('videos/02.mp4') }}" type="video/mp4">
        </video>
        <div class="carousel-overlay">
            <div class="carousel-content">
                <h1 class="hero-title">Tratamientos Personalizados</h1>
                <p class="hero-subtitle">Adaptados a tus necesidades</p>
            </div>
        </div>
    </div>

    <div class="carousel-slide">
        <video muted loop playsinline class="carousel-video">
            <source src="{{ asset('videos/03.mp4') }}" type="video/mp4">
        </video>
        <div class="carousel-overlay">
            <div class="carousel-content">
                <h1 class="hero-title">Reserva Tu Cita Hoy</h1>
                <p class="hero-subtitle">Sistema de reservas 24/7</p>
            </div>
        </div>
    </div>

    {{-- Carousel Indicators --}}
    <div class="carousel-indicators">
        <span class="indicator active" data-slide="0"></span>
        <span class="indicator" data-slide="1"></span>
        <span class="indicator" data-slide="2"></span>
        <span class="indicator" data-slide="3"></span>
    </div>
</div>

{{-- Include Carousel Styles --}}
<link rel="stylesheet" href="{{ asset('css/hero-carousel.css') }}">

{{-- Include Carousel Script --}}
<script src="{{ asset('js/hero-carousel.js') }}" defer></script>
