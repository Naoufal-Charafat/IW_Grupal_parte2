<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contacto - FisioClinic</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
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
        
        /* Navegación */
        .nav {
            background: var(--blanco);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 20px 0;
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
            color: var(--azul);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo-icon {
            background: var(--azul);
            color: var(--blanco);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .nav-links {
            display: flex;
            gap: 25px;
            align-items: center;
        }
        
        .nav-link {
            color: var(--texto);
            text-decoration: none;
            font-weight: 500;
        }
        
        .nav-link:hover {
            color: var(--turquesa);
        }
        
        .nav-link.active {
            color: var(--azul);
            font-weight: 600;
        }
        
        .btn {
            background: linear-gradient(135deg, var(--azul), var(--turquesa));
            color: var(--blanco);
            padding: 10px 22px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        /* Hero Contacto */
        .contact-hero {
            background: linear-gradient(135deg, rgba(0, 102, 204, 0.08), rgba(0, 151, 167, 0.08));
            padding: 120px 0 60px;
            margin-top: 80px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .hero-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .hero-content h1 {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--texto);
            margin-bottom: 15px;
        }
        
        .hero-content p {
            font-size: 1.2rem;
            color: #546E7A;
        }
        
        /* Secciones */
        .section {
            padding: 80px 0;
        }
        
        .section-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--texto);
            margin-bottom: 15px;
            text-align: center;
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
        
        /* Tarjetas de contacto */
        .contact-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        
        .contact-card {
            background: var(--blanco);
            padding: 40px 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border-top: 4px solid var(--azul);
            transition: transform 0.3s ease;
        }
        
        .contact-card:hover {
            transform: translateY(-10px);
        }
        
        .contact-icon {
            background: linear-gradient(135deg, var(--azul), var(--turquesa));
            color: white;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 2rem;
        }
        
        .contact-card h3 {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--texto);
            margin-bottom: 15px;
        }
        
        .contact-card p {
            color: #546E7A;
            margin-bottom: 15px;
            line-height: 1.6;
        }
        
        .contact-link {
            color: var(--azul);
            font-weight: 600;
            text-decoration: none;
            font-size: 1.1rem;
        }
        
        .contact-link:hover {
            text-decoration: underline;
        }
        
        /* Mapa y Horario */
        .map-horario {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 40px;
            margin-top: 50px;
        }
        
        .mapa-container {
            background: var(--blanco);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        
        .horario-container {
            background: var(--blanco);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        
        .horario-title {
            font-size: 1.5rem;
            color: var(--texto);
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .horario-title i {
            color: var(--azul);
        }
        
        .horario-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        
        .horario-day {
            font-weight: 600;
            color: var(--texto);
        }
        
        .horario-time {
            color: #546E7A;
        }
        
        .horario-closed {
            color: #e74c3c;
            font-weight: 600;
        }
        
        .emergency-box {
            background: rgba(231, 76, 60, 0.05);
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            border-left: 4px solid #e74c3c;
        }
        
        /* FAQ */
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .faq-item {
            background: var(--blanco);
            border-radius: 10px;
            margin-bottom: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .faq-question {
            padding: 20px;
            font-weight: 600;
            color: var(--texto);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .faq-question i {
            color: var(--azul);
            transition: transform 0.3s;
        }
        
        .faq-answer {
            padding: 0 20px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .faq-item.active .faq-answer {
            padding: 0 20px 20px;
            max-height: 500px;
        }
        
        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }
        
        /* Footer */
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
        
        /* Responsive */
        @media (max-width: 768px) {
            .contact-hero {
                padding: 100px 0 40px;
            }
            
            .hero-content h1 {
                font-size: 2.2rem;
            }
            
            .map-horario {
                grid-template-columns: 1fr;
            }
            
            .nav-links {
                display: none;
            }
            
            .section {
                padding: 60px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navegación -->
    <nav class="nav">
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
                <a href="{{ route('contacto') }}" class="nav-link active">Contacto</a>
                
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

    <!-- Hero Contacto -->
    <section class="contact-hero">
        <div class="container">
            <div class="hero-content">
                <h1>Contáctanos</h1>
                <p>Estamos aquí para ayudarte en tu recuperación. Visítanos en Alicante o contáctanos a través de los siguientes medios.</p>
            </div>
        </div>
    </section>

    <!-- Información de contacto -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Nuestros Canales de Contacto</h2>
            <p class="section-subtitle">Puedes contactarnos de diferentes formas</p>
            
            <div class="contact-cards">
                <!-- Teléfono -->
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h3>Teléfono</h3>
                    <p>Llama a nuestro equipo de atención al paciente</p>
                    <a href="tel:+34965123456" class="contact-link">+34 965 123 456</a>
                    <p style="margin-top: 10px; color: #546E7A; font-size: 0.95rem;">
                        <i class="fas fa-clock" style="margin-right: 5px;"></i>
                        Lunes a Viernes: 9:00-21:00
                    </p>
                </div>
                
                <!-- Email -->
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3>Email</h3>
                    <p>Escríbenos directamente a nuestro correo</p>
                    <a href="mailto:info@fisioclinic.com" class="contact-link">info@fisioclinic.com</a>
                    <p style="margin-top: 10px; color: #546E7A; font-size: 0.95rem;">
                        <i class="fas fa-reply" style="margin-right: 5px;"></i>
                        Respondemos en menos de 24 horas
                    </p>
                </div>
                
                <!-- Dirección -->
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Visítanos en Alicante</h3>
                    <p>
                        <strong>FisioClinic Alicante</strong><br>
                        Avenida Dr. Gadea, 123<br>
                        03015 Alicante<br>
                        <span style="color: var(--azul); font-weight: 600;">
                            <i class="fas fa-subway" style="margin-right: 5px;"></i>
                            Cercanías: Estación Alicante
                        </span>
                    </p>
                    <p style="margin-top: 10px; color: #546E7A; font-size: 0.95rem;">
                        <i class="fas fa-car" style="margin-right: 5px;"></i>
                        Parking disponible en el centro
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mapa y Horario -->
    <section class="section" style="background: #F8F9FA;">
        <div class="container">
            <h2 class="section-title">Ubicación y Horarios</h2>
            <p class="section-subtitle">Encuéntranos fácilmente en Alicante</p>
            
            <div class="map-horario">
                <!-- Mapa de Alicante -->
                <div class="mapa-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12467.396260042778!2d-0.4910911561740532!3d38.345001497583995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6236ba2a07b50f%3A0x161c6e192605005b!2sUniversidad%20de%20Alicante!5e0!3m2!1ses!2ses!4v1704399999999!5m2!1ses!2ses" 
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                
                <!-- Horario -->
                <div class="horario-container">
                    <h3 class="horario-title">
                        <i class="fas fa-clock"></i>
                        Horario de Atención
                    </h3>
                    
                    <div style="margin-bottom: 30px;">
                        <div class="horario-item">
                            <span class="horario-day">Lunes - Viernes</span>
                            <span class="horario-time">9:00 - 21:00</span>
                        </div>
                        <div class="horario-item">
                            <span class="horario-day">Sábados</span>
                            <span class="horario-time">9:00 - 14:00</span>
                        </div>
                        <div class="horario-item">
                            <span class="horario-day">Domingos</span>
                            <span class="horario-closed">Cerrado</span>
                        </div>
                    </div>
                    
                    <div class="emergency-box">
                        <h4 style="color: #e74c3c; margin-bottom: 10px; font-weight: 600;">
                            <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                            Atención de Emergencias
                        </h4>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.5;">
                            Para urgencias fuera de horario, contacta al <strong>112</strong> o acude al servicio de urgencias del Hospital General Universitario de Alicante.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Preguntas Frecuentes -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Preguntas Frecuentes</h2>
            <p class="section-subtitle">Resolvemos tus dudas más comunes</p>
            
            <div class="faq-container">
                <!-- FAQ 1 -->
                <div class="faq-item">
                    <div class="faq-question">
                        ¿Necesito cita previa para una consulta?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Sí, para garantizar la mejor atención y el tiempo necesario para cada paciente, es imprescindible solicitar cita previa. Puedes hacerlo llamando a nuestro teléfono o a través de nuestra web.</p>
                    </div>
                </div>
                
                <!-- FAQ 2 -->
                <div class="faq-item">
                    <div class="faq-question">
                        ¿Aceptan seguros médicos?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Trabajamos con las principales compañías de seguros: Sanitas, Adeslas, ASISA, DKV, MAPFRE y muchas más. Consulta con nuestro personal administrativo para verificar la cobertura de tu póliza.</p>
                    </div>
                </div>
                
                <!-- FAQ 3 -->
                <div class="faq-item">
                    <div class="faq-question">
                        ¿Qué debo llevar a mi primera consulta?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Para tu primera consulta te recomendamos traer:
                        <ul style="margin-left: 20px; margin-top: 10px;">
                            <li>Documento de identidad</li>
                            <li>Tarjeta sanitaria o seguro médico</li>
                            <li>Informes médicos previos (si los tienes)</li>
                            <li>Pruebas de imagen (radiografías, resonancias)</li>
                        </ul>
                        </p>
                    </div>
                </div>
                
                <!-- FAQ 4 -->
                <div class="faq-item">
                    <div class="faq-question">
                        ¿Cuánto dura una sesión de fisioterapia?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>La duración de las sesiones varía según el tratamiento:
                        <ul style="margin-left: 20px; margin-top: 10px;">
                            <li><strong>Primera consulta:</strong> 45-60 minutos (valoración completa)</li>
                            <li><strong>Sesiones de tratamiento:</strong> 30-45 minutos</li>
                            <li><strong>Rehabilitación deportiva:</strong> 45-60 minutos</li>
                        </ul>
                        </p>
                    </div>
                </div>
                
                <!-- FAQ 5 -->
                <div class="faq-item">
                    <div class="faq-question">
                        ¿Tienen parking para pacientes?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Sí, disponemos de parking gratuito para nuestros pacientes. Se encuentra en la parte trasera del edificio. Nuestro personal te indicará cómo acceder cuando reserves tu cita.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3 style="color: white; margin-bottom: 20px;">FisioClinic Alicante</h3>
                    <p style="color: #B0BEC5;">
                        Centro especializado en fisioterapia avanzada y recuperación funcional en Alicante.
                    </p>
                </div>
                
                <div>
                    <h3 style="color: white; margin-bottom: 20px;">Contacto</h3>
                    <p style="color: #B0BEC5; margin-bottom: 10px;">
                        <i class="fas fa-phone"></i> +34 965 123 456
                    </p>
                    <p style="color: #B0BEC5; margin-bottom: 10px;">
                        <i class="fas fa-envelope"></i> info@fisioclinic.com
                    </p>
                    <p style="color: #B0BEC5;">
                        <i class="fas fa-map-marker-alt"></i> Av. Dr. Gadea, 123<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;03015 Alicante
                    </p>
                </div>
                
                <div>
                    <h3 style="color: white; margin-bottom: 20px;">Horario</h3>
                    <p style="color: #B0BEC5; margin-bottom: 5px;">
                        <strong>Lun-Vie:</strong> 9:00-21:00
                    </p>
                    <p style="color: #B0BEC5; margin-bottom: 5px;">
                        <strong>Sábados:</strong> 9:00-14:00
                    </p>
                    <p style="color: #B0BEC5;">
                        <strong>Domingos:</strong> Cerrado
                    </p>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; {{ date('Y') }} FisioClinic. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript para FAQ -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // FAQ toggle
            const faqQuestions = document.querySelectorAll('.faq-question');
            
            faqQuestions.forEach(question => {
                question.addEventListener('click', () => {
                    const faqItem = question.parentElement;
                    faqItem.classList.toggle('active');
                });
            });
            
            // Navegación suave para enlaces internos
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href === '#') return;
                    
                    const targetElement = document.querySelector(href);
                    if (targetElement) {
                        e.preventDefault();
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>