<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FisioClinic</title>
    
    <!-- Fonts & Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Paleta profesional simplificada */
        :root {
            --azul: #0066CC;
            --turquesa: #0097A7;
            --blanco: #FFFFFF;
            --gris-claro: #F8F9FA;
            --texto: #2C3E50;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: var(--gris-claro);
            font-family: 'Figtree', sans-serif;
            color: var(--texto);
            line-height: 1.6;
        }
        
        /* Navegación simplificada */
        .nav {
            background: transparent;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 20px 0;
            transition: all 0.3s;
        }
        
        .nav.scrolled {
            background: var(--blanco);
            box-shadow: 0 2px 10px rgba(0, 102, 204, 0.1);
        }
        
        .nav-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--blanco);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .nav.scrolled .logo {
            color: var(--azul);
        }
        
        .logo-icon {
            background: var(--blanco);
            color: var(--azul);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .nav.scrolled .logo-icon {
            background: var(--azul);
            color: var(--blanco);
        }
        
        .nav-links {
            display: flex;
            gap: 25px;
            align-items: center;
        }
        
        .nav-link {
            color: var(--blanco);
            text-decoration: none;
            font-weight: 500;
        }
        
        .nav.scrolled .nav-link {
            color: var(--texto);
        }
        
        .nav-link:hover {
            color: var(--turquesa);
        }
        
        .btn {
            background: var(--blanco);
            color: var(--azul);
            padding: 10px 22px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .nav.scrolled .btn {
            background: linear-gradient(135deg, var(--azul), var(--turquesa));
            color: var(--blanco);
        }
        
        /* HERO SECTION MEJORADA (de la segunda versión) */
        .hero {
            position: relative;
            height: 100vh;
            min-height: 700px;
            margin-top: 0;
            overflow: hidden;
        }
        
        .hero-carousel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        .carousel-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            background-size: cover;
            background-position: center;
        }
        
        .carousel-slide.active {
            opacity: 1;
        }
        
        /* Imágenes profesionales para fisioterapia (3 imágenes) */
        .slide-1 {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), 
                              url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');
        }
        
        .slide-2 {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), 
                            url('https://images.unsplash.com/photo-1629909613654-28e377c37b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');
        }
        
        .slide-3 {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), 
                            url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');
        }
        
        .hero-overlay {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--blanco);
            padding: 0 20px;
        }
        
        .hero-content {
            max-width: 800px;
            padding: 20px;
            animation: fadeInUp 1s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero-title {
            font-size: 3.2rem;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .hero-title span {
            color: #4FC3F7;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 40px;
            opacity: 0.95;
            line-height: 1.6;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        .hero-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-bottom: 50px;
            flex-wrap: wrap;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--azul), var(--turquesa));
            color: white;
            padding: 14px 35px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-size: 1.1rem;
        }
        
        .btn-secondary {
            background: transparent;
            color: white;
            padding: 14px 35px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-size: 1.1rem;
            border: 2px solid white;
        }
        
        /* ESTADÍSTICAS DEL HERO (nuevas) */
        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 800px;
            margin: 0 auto;
        }
        
        .stat {
            text-align: center;
            flex: 1;
            min-width: 120px;
        }
        
        .stat-number {
            display: block;
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
        }
        
        .carousel-dots {
            position: absolute;
            bottom: 40px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 10px;
            z-index: 3;
        }
        
        .carousel-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            border: none;
            cursor: pointer;
        }
        
        .carousel-dot.active {
            background: white;
            transform: scale(1.2);
        }
        
        /* Secciones generales (simplificadas) */
        .section {
            padding: 80px 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .section-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--texto);
            margin-bottom: 15px;
        }
        
        .section-subtitle {
            text-align: center;
            color: #546E7A;
            font-size: 1.1rem;
            margin-bottom: 50px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Características optimizadas */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        
        .feature {
            background: var(--blanco);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .feature-icon {
            background: linear-gradient(135deg, var(--azul), var(--turquesa));
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        
        .feature h3 {
            color: var(--texto);
            margin-bottom: 10px;
            font-size: 1.3rem;
        }
        
        .feature p {
            color: #546E7A;
            font-size: 0.95rem;
        }
        
        /* Equipo optimizado */
        .team-container {
            display: flex;
            gap: 25px;
            overflow-x: auto;
            padding: 10px;
            scrollbar-width: none;
        }
        
        .team-container::-webkit-scrollbar {
            display: none;
        }
        
        .team-card {
            min-width: 300px;
            background: var(--blanco);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        
        .team-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .team-info {
            padding: 20px;
        }
        
        .team-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--texto);
            margin-bottom: 5px;
        }
        
        /* CTA y Footer simplificados */
        .cta {
            background: linear-gradient(135deg, var(--azul), var(--turquesa));
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        
        .footer {
            background: var(--texto);
            color: white;
            padding: 60px 0 30px;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #90A4AE;
        }
        
        /* Responsive mínimo */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .hero-stats {
                gap: 20px;
            }
            
            .nav-links {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Navegación -->
    <nav class="nav" id="mainNav">
        <div class="nav-content">
            <a href="/" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <span>FisioClinic</span>
            </a>
            
            <div class="nav-links">
                <a href="/" class="nav-link">Inicio</a>
                <a href="{{ route('tratamientos.index') }}" class="nav-link">Tratamientos</a>
                <a href="#equipo" class="nav-link">Equipo</a>
                <a href="#contacto" class="nav-link">Contacto</a>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link">Mi Cuenta</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Acceder</a>
                @endauth
                
                <a href="{{ route('tratamientos.index') }}" class="btn">
                    <i class="fas fa-calendar-check"></i> Reservar Cita
                </a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION MEJORADA (con estadísticas y 3 imágenes) -->
    <section class="hero">
        <!-- Carrusel de imágenes -->
        <div class="hero-carousel">
            <div class="carousel-slide slide-1 active"></div>
            <div class="carousel-slide slide-2"></div>
            <div class="carousel-slide slide-3"></div>
        </div>
        
        <!-- Contenido sobre el carrusel -->
        <div class="hero-overlay">
            <div class="hero-content">
                <h1 class="hero-title">
                    Tu <span>Bienestar</span> es Nuestra<br>Mayor Prioridad
                </h1>
                
                
                <div class="hero-buttons">
                    <a href="{{ route('tratamientos.index') }}" class="btn-primary">
                        <i class="fas fa-heartbeat"></i> Ver Tratamientos
                    </a>
                    <a href="{{ route('register') }}" class="btn-secondary">
                        <i class="fas fa-calendar-check"></i> Reservar Primera Cita
                    </a>
                </div>
                
            </div>
        </div>
        
        <!-- Indicadores del carrusel -->
        <div class="carousel-dots">
            <button class="carousel-dot active" data-slide="0"></button>
            <button class="carousel-dot" data-slide="1"></button>
            <button class="carousel-dot" data-slide="2"></button>
        </div>
    </section>

    <!-- Por qué elegirnos -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Excelencia en Fisioterapia</h2>
            <p class="section-subtitle">Combinamos tecnología avanzada con atención personalizada</p>
            
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h3>Equipo Certificado</h3>
                    <p>Fisioterapeutas colegiados con amplia experiencia clínica.</p>
                </div>
                
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-microscope"></i>
                    </div>
                    <h3>Tecnología Avanzada</h3>
                    <p>Equipamiento de última generación para tratamientos precisos.</p>
                </div>
                
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-hand-holding-medical"></i>
                    </div>
                    <h3>Atención Personal</h3>
                    <p>Cada tratamiento se adapta a tus necesidades específicas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tratamientos -->
    <section class="section" style="background-color: #F8F9FA;">
        <div class="container">
            <h2 class="section-title">Tratamientos Especializados</h2>
            <p class="section-subtitle">Soluciones terapéuticas para diferentes condiciones</p>
            
            @if(isset($tratamientosDestacados) && $tratamientosDestacados->count() > 0)
                <div class="features">
                    @foreach($tratamientosDestacados as $tratamiento)
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h3>{{ $tratamiento->nombre }}</h3>
                        <p>{{ Str::limit($tratamiento->descripcion, 100) }}</p>
                        <div style="margin-top: 15px;">
                            <span style="color: var(--azul); font-weight: 600;">
                                {{ number_format($tratamiento->precio, 2) }}€
                            </span>
                            <a href="{{ route('tratamientos.show', $tratamiento) }}" style="color: var(--turquesa); margin-left: 15px;">
                                Ver detalles →
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p style="text-align: center; color: #546E7A;">No hay tratamientos disponibles.</p>
            @endif
        </div>
    </section>

    <!-- Equipo -->
    <section id="equipo" class="section">
        <div class="container">
            <h2 class="section-title">Nuestro Equipo Médico</h2>
            <p class="section-subtitle">Profesionales comprometidos con tu recuperación</p>
            
            @if(isset($profesionales) && $profesionales->count() > 0)
                <div class="team-container">
                    @foreach($profesionales as $profesional)
                    <div class="team-card">
                        <img src="https://images.unsplash.com/photo-1612349317150?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                            alt="{{ $profesional->user->name ?? 'Profesional' }}" class="team-img">
                        <div class="team-info">
                            <h3 class="team-name">{{ $profesional->user->name ?? 'Profesional' }}</h3>
                            <p class="team-specialty" style="color: var(--turquesa); margin-bottom: 15px;">
                                <i class="fas fa-graduation-cap"></i> Fisioterapeuta
                            </p>
                            <p style="color: #546E7A; margin-bottom: 15px;">
                                {{ Str::limit($profesional->biografia ?? 'Especialista en fisioterapia.', 80) }}
                            </p>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="color: var(--azul); font-weight: 600;">
                                    {{ number_format($profesional->tarifa_hora, 2) }}€/hora
                                </span>
                                <a href="#" style="color: var(--turquesa); text-decoration: none;">
                                    <i class="fas fa-calendar-alt"></i> Disponible
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 40px; background: var(--blanco); border-radius: 12px;">
                    <h3 style="color: var(--texto); margin-bottom: 15px;">Equipo en Formación</h3>
                    <p style="color: #546E7A;">Pronto anunciaremos a nuestros especialistas.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <h2>¿Listo para comenzar tu recuperación?</h2>
        <p style="max-width: 600px; margin: 0 auto 30px;">
            Reserva tu primera consulta de valoración
        </p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-primary">
                    <i class="fas fa-calendar-alt"></i> Agendar Cita
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-primary">
                    <i class="fas fa-user-plus"></i> Crear Cuenta
                </a>
                <a href="{{ route('login') }}" class="btn-secondary">
                    <i class="fas fa-sign-in-alt"></i> Acceder
                </a>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer id="contacto" class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3 style="color: white; margin-bottom: 20px;">FisioClinic</h3>
                    <p style="color: #B0BEC5;">
                        Centro especializado en fisioterapia avanzada.
                    </p>
                </div>
                
                <div>
                    <h3 style="color: white; margin-bottom: 20px;">Contacto</h3>
                    <p style="color: #B0BEC5; margin-bottom: 10px;">
                        <i class="fas fa-phone"></i> +34 91 123 45 67
                    </p>
                    <p style="color: #B0BEC5;">
                        <i class="fas fa-envelope"></i> info@fisioclinic.com
                    </p>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; {{ date('Y') }} FisioClinic. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript optimizado -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ========== 1. CARRUSEL AUTOMÁTICO HERO ==========
            const slides = document.querySelectorAll('.carousel-slide');
            const dots = document.querySelectorAll('.carousel-dot');
            
            if (slides.length > 0) {
                let currentSlide = 0;
                const slideInterval = 3000; // Cambia cada 3 segundos
                
                function showSlide(n) {
                    // Ocultar todas las slides
                    slides.forEach(slide => {
                        slide.classList.remove('active');
                    });
                    
                    // Desactivar todos los dots
                    dots.forEach(dot => {
                        dot.classList.remove('active');
                    });
                    
                    // Mostrar slide actual
                    slides[n].classList.add('active');
                    dots[n].classList.add('active');
                    currentSlide = n;
                }
                
                // Cambio automático de slides
                function nextSlide() {
                    currentSlide = (currentSlide + 1) % slides.length;
                    showSlide(currentSlide);
                }
                
                // Iniciar carrusel automático si hay slides
                if (slides.length > 0) {
                    let slideTimer = setInterval(nextSlide, slideInterval);
                    
                    // Control por dots
                    dots.forEach((dot, index) => {
                        dot.addEventListener('click', function() {
                            clearInterval(slideTimer);
                            showSlide(index);
                            slideTimer = setInterval(nextSlide, slideInterval);
                        });
                    });
                    
                    // Pausar carrusel al hacer hover
                    const heroSection = document.querySelector('.hero');
                    if (heroSection) {
                        heroSection.addEventListener('mouseenter', function() {
                            clearInterval(slideTimer);
                        });
                        
                        heroSection.addEventListener('mouseleave', function() {
                            slideTimer = setInterval(nextSlide, slideInterval);
                        });
                    }
                }
            }
            
            // ========== 2. NAVEGACIÓN SCROLL ==========
            const nav = document.getElementById('mainNav');
            if (nav) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 100) {
                        nav.classList.add('scrolled');
                    } else {
                        nav.classList.remove('scrolled');
                    }
                });
            }
            
            // ========== 3. SCROLL SUAVE ==========
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // ========== 4. MENÚ MÓVIL BÁSICO ==========
            const mobileBtn = document.querySelector('.mobile-menu-btn');
            const navLinks = document.querySelector('.nav-links');
            
            if (mobileBtn && navLinks) {
                mobileBtn.addEventListener('click', () => {
                    navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
                });
            }
        });
    </script>
</body>
</html>