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


    .nav.scrolled .logo {
        color: var(--azul);
    }


    .nav.scrolled .logo-icon {
        background: var(--azul);
        color: var(--blanco);
    }


    .nav.scrolled .nav-link {
        color: var(--texto);
    }

    .nav.scrolled .btn {
        background: linear-gradient(135deg, var(--azul), var(--turquesa));
        color: var(--blanco);
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

    .hero-title span {
        color: #4FC3F7;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
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

    .cta-simple h2 {
        color: #4FC3F7; /* Mismo color que "bienestar" */
        font-size: 2rem;
        margin-bottom: 15px;
    }

    .cta-simple p {
        color: #546E7A; /* Gris azulado */
        margin-bottom: 30px;
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
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        color: #90A4AE;
    }

    /* Flechas simples para el equipo */
    .team-nav-btn {
        background: none;
        border: none;
        font-size: 30px;
        color: var(--texto);
        cursor: pointer;
        padding: 10px;
    }

    .team-nav-btn:hover {
        color: var(--azul);
    }

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