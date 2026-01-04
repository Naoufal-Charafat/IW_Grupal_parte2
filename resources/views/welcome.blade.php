<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FisioClinic | Centro Especializado en Fisioterapia</title>
    
    <!-- Fonts y Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        
        :root {
            --azul-profesional: #0066CC;       
            --verde-salud: #2E7D32;            
            --turquesa: #0097A7;                
            --gris-claro: #F8F9FA;           
            --blanco: #FFFFFF;               
            --texto-oscuro: #2C3E50;           
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: var(--gris-claro);
            font-family: 'Figtree', sans-serif;
            color: var(--texto-oscuro);
            line-height: 1.6;
        }
        
        /* Navegación */
        .nav {
            background: var(--blanco);
            box-shadow: 0 2px 10px rgba(0, 102, 204, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 15px 0;
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
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--azul-profesional);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo i {
            color: var(--turquesa);
        }
        
        .nav-links {
            display: flex;
            gap: 25px;
            align-items: center;
        }
        
        .nav-link {
            color: var(--texto-oscuro);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .nav-link:hover {
            color: var(--azul-profesional);
        }
        
        .btn {
            background: linear-gradient(135deg, var(--azul-profesional), var(--turquesa));
            color: white;
            padding: 10px 22px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.3s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        /* HERO SECTION */
        .hero {
            background: linear-gradient(135deg, rgba(0, 102, 204, 0.05), rgba(0, 151, 167, 0.05));
            padding: 150px 0 80px;
            margin-top: 70px;
            text-align: center;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .hero-title {
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--texto-oscuro);
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .hero-title span {
            color: var(--azul-profesional);
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            color: #546E7A;
            margin-bottom: 40px;
            line-height: 1.6;
        }
        
        .hero-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-bottom: 50px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--azul-profesional), var(--turquesa));
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-secondary {
            background: transparent;
            color: var(--azul-profesional);
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 2px solid var(--azul-profesional);
        }
        
        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }
        
        .stat {
            text-align: center;
        }
        
        .stat-number {
            display: block;
            font-size: 2rem;
            font-weight: 700;
            color: var(--azul-profesional);
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: #546E7A;
        }
        
        /* Secciones generales simplificadas */
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
            color: var(--texto-oscuro);
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
        
        /* Características  */
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
            background: linear-gradient(135deg, var(--azul-profesional), var(--turquesa));
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.5rem;
        }
        
        .feature h3 {
            color: var(--texto-oscuro);
            margin-bottom: 10px;
            font-size: 1.3rem;
        }
        
        .feature p {
            color: #546E7A;
            font-size: 0.95rem;
        }
        
        /* Slider de profesionales */
        .team-slider {
            position: relative;
            margin-top: 40px;
        }
        
        .team-container {
            display: flex;
            gap: 25px;
            overflow-x: auto;
            scroll-behavior: smooth;
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
            color: var(--texto-oscuro);
            margin-bottom: 5px;
        }
        
        .team-specialty {
            color: var(--turquesa);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        .team-bio {
            color: #546E7A;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        /* CTA  */
        .cta {
            background: linear-gradient(135deg, var(--azul-profesional), var(--turquesa));
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        
        .cta h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
        }
        
        /* Footer */
        .footer {
            background: var(--texto-oscuro);
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
            font-size: 0.9rem;
        }
        
        /* Responsive  */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .hero-stats {
                gap: 30px;
            }
            
            .nav-links {
                display: none;
            }
            
            .mobile-menu-btn {
                display: block;
                background: none;
                border: none;
                color: var(--azul-profesional);
                font-size: 1.5rem;
                cursor: pointer;
            }
        }
    </style>
</head>
<body>
    <!-- Navegación  -->
    <nav class="nav">
        <div class="nav-content">
            <a href="/" class="logo">
                <i class="fas fa-hands-helping"></i>
                FisioClinic
            </a>
            
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            
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
                    <i class="fas fa-calendar-check"></i> Reservar
                </a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION  -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">
                Especialistas en <span>Fisioterapia Avanzada</span>
            </h1>
            
            <p class="hero-subtitle">
                Recupera tu movilidad y calidad de vida con tratamientos personalizados 
                y la atención de profesionales certificados.
            </p>
            
            <div class="hero-buttons">
                <a href="{{ route('tratamientos.index') }}" class="btn-primary">
                    <i class="fas fa-heartbeat"></i> Ver Tratamientos
                </a>
                <a href="{{ route('register') }}" class="btn-secondary">
                    <i class="fas fa-calendar-check"></i> Primera Consulta
                </a>
            </div>
            
            <div class="hero-stats">
                <div class="stat">
                    <span class="stat-number">15+</span>
                    <span class="stat-label">Años Experiencia</span>
                </div>
                <div class="stat">
                    <span class="stat-number">98%</span>
                    <span class="stat-label">Satisfacción</span>
                </div>
                <div class="stat">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Reservas Online</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Por qué elegirnos -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Excelencia en Fisioterapia</h2>
            <p class="section-subtitle">
                Combinamos tecnología avanzada con atención personalizada
            </p>
            
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
                
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Horario Flexible</h3>
                    <p>Atención de lunes a sábado, adaptándonos a tu disponibilidad.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tratamientos desde BD  -->
    <section class="section" style="background-color: #F8F9FA;">
        <div class="container">
            <h2 class="section-title">Tratamientos Especializados</h2>
            <p class="section-subtitle">
                Soluciones terapéuticas para diferentes condiciones
            </p>
            
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
                            <span style="color: var(--azul-profesional); font-weight: 600;">
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

    <!-- Equipo desde BD  -->
    <section id="equipo" class="section">
        <div class="container">
            <h2 class="section-title">Nuestro Equipo Médico</h2>
            <p class="section-subtitle">
                Profesionales comprometidos con tu recuperación
            </p>
            
            @if(isset($profesionales) && $profesionales->count() > 0)
                <div class="team-slider">
                    <div class="team-container">
                        @foreach($profesionales as $profesional)
                        <div class="team-card">
                            <img src="https://images.unsplash.com/photo-{{ $loop->index == 0 ? '1612349317150' : ($loop->index == 1 ? '1591604021695' : '1559839734') }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                alt="{{ $profesional->user->name ?? 'Profesional' }}" class="team-img">
                            <div class="team-info">
                                <h3 class="team-name">{{ $profesional->user->name ?? 'Profesional' }}</h3>
                                <div class="team-specialty">
                                    <i class="fas fa-graduation-cap"></i> Fisioterapeuta
                                </div>
                                <p class="team-bio">
                                    {{ Str::limit($profesional->biografia ?? 'Especialista en fisioterapia con amplia experiencia.', 80) }}
                                </p>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px;">
                                    <span style="color: var(--azul-profesional); font-weight: 600;">
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
                </div>
            @else
                <div style="text-align: center; padding: 40px; background: var(--blanco); border-radius: 12px;">
                    <h3 style="color: var(--texto-oscuro); margin-bottom: 15px;">Equipo en Formación</h3>
                    <p style="color: #546E7A;">Pronto anunciaremos a nuestros especialistas.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA  -->
    <section class="cta">
        <h2>¿Listo para comenzar tu recuperación?</h2>
        <p style="max-width: 600px; margin: 0 auto 30px; font-size: 1.1rem;">
            Reserva tu primera consulta de valoración
        </p>
        <div class="hero-buttons">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-primary">
                    <i class="fas fa-calendar-alt"></i> Agendar Cita
                </a>
            @else
                <a href="{{ route('register') }}" class="btn-primary">
                    <i class="fas fa-user-plus"></i> Crear Cuenta
                </a>
                <a href="{{ route('login') }}" class="btn-secondary" style="border-color: white; color: white;">
                    <i class="fas fa-sign-in-alt"></i> Acceder
                </a>
            @endauth
        </div>
    </section>

    <!-- Footer  -->
    <footer id="contacto" class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3 style="color: white; margin-bottom: 20px;">FisioClinic</h3>
                    <p style="color: #B0BEC5; font-size: 0.95rem;">
                        Centro especializado en fisioterapia avanzada.
                    </p>
                </div>
                
                <div>
                    <h3 style="color: white; margin-bottom: 20px;">Contacto</h3>
                    <p style="color: #B0BEC5; margin-bottom: 10px;">
                        <i class="fas fa-phone" style="margin-right: 10px;"></i> +34 91 123 45 67
                    </p>
                    <p style="color: #B0BEC5; margin-bottom: 10px;">
                        <i class="fas fa-envelope" style="margin-right: 10px;"></i> info@fisioclinic.com
                    </p>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; {{ date('Y') }} FisioClinic. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript  -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Slider simple
            const container = document.querySelector('.team-container');
            
            if (container) {
                let isDown = false;
                let startX;
                let scrollLeft;
                
                container.addEventListener('mousedown', (e) => {
                    isDown = true;
                    startX = e.pageX - container.offsetLeft;
                    scrollLeft = container.scrollLeft;
                });
                
                container.addEventListener('mouseleave', () => {
                    isDown = false;
                });
                
                container.addEventListener('mouseup', () => {
                    isDown = false;
                });
                
                container.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - container.offsetLeft;
                    const walk = (x - startX) * 2;
                    container.scrollLeft = scrollLeft - walk;
                });
            }
            
            // Scroll suave
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 70,
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Menú móvil básico
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