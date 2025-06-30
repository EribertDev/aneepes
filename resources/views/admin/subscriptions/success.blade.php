@extends('dashboard')
@section('title', 'Paiement réussi')

@section('extra-style')
<style>
    .payment-result {
        max-width: 500px;
        margin: 2rem auto;
    }
    
    .result-card {
        background: white;
        border-radius: 15px;
        padding: 3rem 2rem;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .result-icon {
        font-size: 5rem;
        margin-bottom: 1.5rem;
    }
    
    .success .result-icon {
        color: #28a745;
    }
    
    h2 {
        color: #0055A4;
        margin-bottom: 1rem;
    }
    
    .btn-home {
        display: inline-block;
        margin-top: 2rem;
        padding: 0.8rem 2rem;
        background: #0055A4;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.3s;
    }
    
    .btn-home:hover {
        background: #003F7F;
    }
    </style>
@endsection

@section('content')
<div class="payment-result">
    <div class="result-card success">
        <div class="result-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2>Paiement réussi !</h2>
        <p>Votre cotisation a été payée avec succès.</p>
        <a href="{{ route('subscriptions.index') }}" class="btn-home">Retour à l'accueil</a>
    </div>
</div>


@endsection