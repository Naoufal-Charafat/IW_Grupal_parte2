<nav class="nav transparent" id="mainNav">
    <div class="nav-content">
        <a href="{{ url('/') }}" class="logo">
            <div class="logo-icon"><i class="fas fa-heartbeat"></i></div>
            FisioClinic
        </a>

        <!-- Botón Hamburguesa Mobile -->
        <button class="hamburger" id="hamburger" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Links Desktop -->
        <div class="nav-links">
            <!--<a href="{{ url('/#equipo') }}" class="nav-link">Equipo</a>-->
            <a href="{{ route('tratamientos.index') }}" class="nav-link">Tratamientos</a>
            <a href="{{ route('tienda.index') }}" class="nav-link">Tienda</a>
            <a href="{{ route('contacto.index') }}" class="nav-link">Contacto</a>

            @if (Route::has('login'))
                <div style="margin-left: 20px;">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-nav">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link" style="margin-right: 15px;">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-nav">Registrarse</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</nav>

<!-- Sidebar Mobile -->
<div class="mobile-sidebar" id="mobileSidebar">
    <div class="sidebar-content">
        <a href="{{ route('tratamientos.index') }}" class="sidebar-link">
            <i class="fas fa-clipboard-list"></i> Tratamientos
        </a>
        
        <a href="{{ route('contacto.index') }}" class="sidebar-link">
            <i class="fas fa-envelope"></i> Contacto
        </a>

        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="sidebar-link">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="sidebar-link">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="sidebar-link">
                        <i class="fas fa-user-plus"></i> Registrarse
                    </a>
                @endif
            @endauth
        @endif
    </div>
</div>

<!-- Overlay para cerrar sidebar -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div style="height: 80px;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('mobileSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const nav = document.getElementById('mainNav');

        function toggleMenu() {
            hamburger.classList.toggle('active');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
        }

        hamburger.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);

        // Cerrar al hacer click en un enlace
        const sidebarLinks = sidebar.querySelectorAll('.sidebar-link');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', toggleMenu);
        });

        // Handle scroll for transparent header effect
        function handleScroll() {
            if (window.scrollY > 50) {
                nav.classList.remove('transparent');
                nav.classList.add('scrolled');
            } else {
                nav.classList.add('transparent');
                nav.classList.remove('scrolled');
            }
        }

        // Listen to scroll events
        window.addEventListener('scroll', handleScroll);
        
        // Initial check
        handleScroll();
    });
</script>
