@extends('dashboard')
@section('title', 'Paiement échoué')

@section('extra-style')
<style>
    .failed .result-icon {
        color: #dc3545;
    }
    
    .btn-retry {
        display: inline-block;
        margin-top: 2rem;
        padding: 0.8rem 2rem;
        background: #dc3545;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.3s;
    }
    
    .btn-retry:hover {
        background: #c82333;
    }
    </style>
@endsection

@section('content')
<div class="payment-result">
    <div class="result-card failed">
        <div class="result-icon">
            <i class="fas fa-times-circle"></i>
        </div>
        <h2>Paiement échoué</h2>
        <p>Votre paiement n'a pas pu être traité. Veuillez réessayer.</p>
        <a href="{{ route('subscriptions.payment') }}" class="btn-retry">Réessayer</a>
    </div>
</div>


@endsection