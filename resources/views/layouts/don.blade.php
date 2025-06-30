@extends('master')
@section('title', 'Dons')
@section('extra-style')
<style>
    :root {
        --primary-maroon: #A12C2F;
        --accent-gold: #D4AF37;
        --light-bg: #faf6f0;
    }

    .donation-hero {
        background: linear-gradient(135deg, var(--primary-maroon) 0%, #871F22 100%);
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }

    .logo-pulse {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .donation-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
    }

    .donation-card:hover {
        transform: translateY(-10px);
    }

    .donate-btn {
        background: linear-gradient(45deg, var(--accent-gold) 0%, #c5a338 100%);
        border: none;
        padding: 1rem 3rem;
        font-size: 1.2rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .donate-btn::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(45deg);
        transition: all 0.5s ease;
    }

    .donate-btn:hover::after {
        left: 120%;
    }

    .particles {
        position: absolute;
        width: 100%;
        height: 100%;a
        pointer-events: none;
    }
</style>
@endsection

@section('content')


<section class="donation-hero d-flex align-items-center">
    <div class="particles"></div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                
                <div class="donation-card p-5 mb-4">
                    <h1 class="display-4 mb-4" style="color: var(--primary-maroon); font-family: 'Playfair Display', serif;">
                        Soutenez l'éducation de demain
                    </h1>
                    
                    <p class="lead mb-4">
                        Votre don contribue à développer l'excellence académique et l'innovation pédagogique
                    </p>

                    <a 
                    onclick="window.location.href='https://sandbox-me.fedapay.com/KiEqwyWD'" class="btn donate-btn rounded-pill text-white">
                        Faire un don maintenant 
                        <i class="fas fa-hand-holding-heart ms-2"></i>
                    </a>
                </div>

                <div class="text-white opacity-75">
                    <small><i class="fas fa-lock me-2"></i>Paiement 100% sécurisé</small>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection




