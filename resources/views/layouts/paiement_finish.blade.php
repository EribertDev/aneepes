@extends('master')
@section('title', 'Paiement')
@section('extra-style')
<style>
    .confetti {
        position: fixed;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 999;
    }

    .checkmark-animation {
        animation: checkmark 3s ease;
    }

    @keyframes checkmark {
        0% { transform: scale(0); opacity: 0; }
        80% { transform: scale(1.2); }
        100% { transform: scale(1); opacity: 1; }
    }

    .success-card {
        background: linear-gradient(135deg, rgba(161,44,47,0.95) 0%, rgba(135,31,34,0.95) 100%);
        backdrop-filter: blur(10px);
        border: 2px solid var(--accent-gold);
    }

    .progress-bar-gold {
        height: 8px;
        background: linear-gradient(90deg, var(--accent-gold) 0%, #c5a338 100%);
        animation: progress 4s ease;
    }

    @keyframes progress {
        0% { width: 0% }
        100% { width: 100% }
    }
</style>
 
@endsection

@section('content')

<div class="confetti"></div>

    <section class="donation-hero d-flex align-items-center mt-3">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="success-card p-5 rounded-4 text-white mt-3 mb-4">
                        <div class="checkmark-animation mb-4">
                            <i class="fas fa-check-circle fa-5x text-gold"></i>
                        </div>

                        <h2 class="mb-4 fw-bold">Merci pour votre générosité !</h2>
                        
                        <div class="progress-bar-gold w-100 mb-4 rounded-pill"></div>

                       

                        <div class="d-flex gap-3 justify-content-center">
                          
                            <a href="/" class="btn btn-gold rounded-pill">
                                Retour à l'accueil
                            </a>
                        </div>

                        <div class="mt-5 pt-4 border-top border-gold">
                            <small>
                                Vous recevrez un reçu fiscal par email dans les 24h.<br>
                                <i class="fas fa-envelope me-2"></i>contact@aneepes.bj
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection




