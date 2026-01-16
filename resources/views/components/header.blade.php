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
