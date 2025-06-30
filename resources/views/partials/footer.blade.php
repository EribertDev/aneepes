<style>
    :root {
        --primary-maroon: #A12C2F;
        --accent-gold: #D4AF37;
        --light-bg: #faf6f0;
    }

    .footer-wave {
        background: linear-gradient(170deg, var(--primary-maroon) 60%, #871F22 100%);
        position: relative;
        overflow: hidden;
    }

    .footer-wave::before {
        content: '';
        position: absolute;
        top: -50px;
        left: 0;
        width: 100%;
        height: 100px;
        background: url("data:image/svg+xml,%3Csvg viewBox='0 0 1440 320' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill='%23faf6f0' fill-opacity='1' d='M0 64L48 90.7C96 117 192 171 288 181.3C384 192 480 160 576 138.7C672 117 768 107 864 122.7C960 139 1056 181 1152 192C1248 203 1344 181 1392 170.7L1440 160L1440 0L1392 0C1344 0 1248 0 1152 0C1056 0 960 0 864 0C768 0 672 0 576 0C480 0 384 0 288 0C192 0 96 0 48 0L0 0Z'/%3E%3C/svg%3E");
    }

    .footer-logo {
        max-height: 80px;
        max-width: 80px;
        transition: transform 0.3s ease;
    }

    .footer-logo:hover {
        transform: scale(1.05);
    }

    .newsletter-input {
        border: 2px solid var(--accent-gold) !important;
        background: rgba(255, 255, 255, 0.1) !important;
        color: white !important;
    }

    .newsletter-input::placeholder {
        color: rgba(255, 255, 255, 0.7) !important;
    }

    .social-icon {
        font-size: 1.5rem;
        color: var(--accent-gold);
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        color: white;
        transform: translateY(-3px);
    }
</style>

<footer class="footer-wave pt-5">
    <div class="container">
        <div class="row g-5 pb-4">
            <!-- Colonne Logo + Motto -->
            <div class="col-md-4 text-center text-md-start">
                <img src="{{asset('assets/images/anepes-logo.jpg')}}" alt="ANEEPES Logo" class="footer-logo mb-3">
                <p class="mt-2 fw-light opacity-75">"Solidarité – Innovation - Excellence"</p>
            </div>

            <!-- Colonne Liens rapides -->
            <div class="col-md-3">
                <h5 class="text-gold mb-4">Navigation</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-gold">Actualités</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-gold">Membres</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-gold">Événements</a></li>
                    <li><a href="#" class="text-white text-decoration-none hover-gold">Contact</a></li>
                </ul>
            </div>

            <!-- Colonne Newsletter -->
            <div class="col-md-5">
                <h5 class="text-gold mb-4">Restez informés</h5>
                @if(session('newsletter_success'))
                    <div class="alert alert-gold alert-dismissible fade show mb-3" role="alert">
                        {{ session('newsletter_success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="d-flex gap-2">
                    @csrf
                    <input type="email" name="email" 
                           class="form-control newsletter-input rounded-pill" 
                           placeholder="Votre email" required>
                    <button type="submit" 
                            class="btn btn-gold rounded-pill px-4"
                            style="background: var(--accent-gold); color: var(--primary-maroon); font-weight: 600">
                        S'abonner
                    </button>
                </form>
                
                <!-- Réseaux sociaux -->
                <div class="mt-4 d-flex gap-3 justify-content-center justify-content-md-start">
                    <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-top border-gold pt-4 mt-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="small mb-0 opacity-75">© 2025 ANEEPES-Bénin - Tous droits réservés</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="small mb-0 opacity-75">
                        <i class="fas fa-map-marker-alt me-2"></i>Cotonou, Bénin<br>
                        <i class="fas fa-envelope me-2"></i>contact@aneepes.bj<br>
                        <i class="fas fa-phone me-2"></i>+229 12 34 56 78
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>