<footer id="contacto" class="footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Columna 1: Información de la Clínica -->
            <div>
                <h3 class="footer-title">FisioClinic</h3>
                <p class="footer-text">
                    Centro especializado en fisioterapia avanzada. Cuidamos de tu salud con profesionalismo y
                    dedicación.
                </p>
                <div class="footer-social">
                    <a href="#" class="social-link" aria-label="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>

            <!-- Columna 2: Enlaces Rápidos -->
            <div>
                <h3 class="footer-title">Enlaces Rápidos</h3>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="{{ route('tratamientos.index') }}"><i class="fas fa-clipboard-list"></i>
                            Tratamientos</a></li>
                    @auth
                        <li><a href="{{ url('/dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a></li>
                        <li><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Registrarse</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Columna 3: Servicios -->
            <div>
                <h3 class="footer-title">Servicios</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('tratamientos.index') }}"><i class="fas fa-hand-holding-medical"></i>
                            Fisioterapia Manual</a></li>
                    <li><a href="{{ route('tratamientos.index') }}"><i class="fas fa-running"></i> Rehabilitación
                            Deportiva</a></li>
                    <li><a href="{{ route('tratamientos.index') }}"><i class="fas fa-spa"></i> Masajes Terapéuticos</a>
                    </li>
                    <li><a href="{{ route('tratamientos.index') }}"><i class="fas fa-heartbeat"></i> Electroterapia</a>
                    </li>
                </ul>
            </div>

            <!-- Columna 4: Contacto -->
            <div>
                <h3 class="footer-title">Contacto</h3>
                <ul class="footer-contact">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Calle Principal 123<br>28001 Madrid, España</span>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <span>+34 91 123 45 67</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>info@fisioclinic.com</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>Lun - Vie: 9:00 - 20:00</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="copyright">
            <p>&copy; {{ date('Y') }} FisioClinic. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
