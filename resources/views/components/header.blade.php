@props([])
<body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
<style>
    /* Navbar Base Styles */
    .nav {
        background: #FFFFFF;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        padding: 20px 0;
        transition: all 0.3s;
        box-shadow: 0 2px 10px rgba(0, 102, 204, 0.1);
    }

    /* Scrolled State (added via JS) */
    .nav.scrolled {
        background: #FFFFFF;
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

    /* Logo Styling */
    .logo {
        font-size: 1.6rem;
        font-weight: 700;
        color: #0066CC; /* White on transparent, Blue on white */
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .nav.scrolled .logo {
        color: #0066CC;
    }

    .logo-icon {
        background: #0066CC;
        color: #FFFFFF;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nav.scrolled .logo-icon {
        background: #0066CC;
        color: #FFFFFF;
    }

    /* Links Styling */
    .nav-links {
        display: flex;
        gap: 25px;
        align-items: center;
    }

    .nav-link {
        color: #2C3E50;
        text-decoration: none;
        font-weight: 500;
    }

    .nav.scrolled .nav-link {
        color: #2C3E50;
    }

    .nav-link:hover {
        color: #0097A7;
    }

    /* Buttons */
    .btn-nav {
        background: linear-gradient(135deg, #0066CC, #0097A7);
        color: #FFFFFF;
        padding: 10px 22px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
    }

    .nav.scrolled .btn-nav {
        background: linear-gradient(135deg, #0066CC, #0097A7);
        color: #FFFFFF;
    }

    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        /* Mobile Menu hidden for now */
    }

</style>

<nav class="nav" id="mainNav">
    <div class="nav-content">
        <a href="{{ url('/') }}" class="logo">
            <div class="logo-icon"><i class="fas fa-heartbeat"></i></div>
            FisioClinic
        </a>

        <div class="nav-links">
            <!--<a href="{{ url('/#equipo') }}" class="nav-link">Equipo</a>-->
            <a href="{{ route('tratamientos.index') }}" class="nav-link">Tratamientos</a>
            <!-- <a href="{{ url('/#contacto') }}" class="nav-link">Contacto</a> -->

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
<div style="height: 80px;"></div>
