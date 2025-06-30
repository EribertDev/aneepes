@extends('dashboard')
@section('title', 'Cotisations')
@section('page-title', 'Cotisations')
@section('extra-style')
<style>
    .subscription-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 1rem;
    }
    
    .subscription-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .subscription-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    
    .subscription-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s;
    }
    
    .subscription-card:hover {
        transform: translateY(-5px);
    }
    
    .card-header {
        padding: 1.5rem;
        background: #0055A4;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .card-header h3 {
        margin: 0;
        font-size: 1.2rem;
    }
    
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
    }
    
    .status-paid .status-badge { background: #28a745; }
    .status-pending .status-badge { background: #ffc107; color: #212529; }
    .status-failed .status-badge { background: #dc3545; }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .amount {
        font-size: 1.8rem;
        font-weight: bold;
        color: #0055A4;
        margin-bottom: 1rem;
    }
    
    .paid-date {
        color: #6c757d;
        font-size: 0.9rem;
    }
    </style>
@endsection

@section('content')

<div class="subscription-container">
    <div class="subscription-header">
        <h2><i class="fas fa-calendar-check"></i> Mes Cotisations</h2>
        
        <a href="{{ route('subscriptions.payment') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouvelle Cotisation
        </a>
      
    </div>

    <div class="subscription-cards">
        @foreach($subscriptions as $subscription)
        <div class="subscription-card status-{{ $subscription->status }}">
            <div class="card-header">
                <h3>    {{ $subscription->month ? \Carbon\Carbon::parse($subscription->month)->format('F Y') : 'Date inconnue' }}</h3>
                <span class="badge status-badge">
                    @if($subscription->status == 'paid')
                    <i class="fas fa-check-circle"></i> Payé
                    @elseif($subscription->status == 'pending')
                    <i class="fas fa-clock"></i> En attente
                    @else
                    <i class="fas fa-times-circle"></i> Échoué
                    @endif
                </span>
            </div>
            <div class="card-body">
                <div class="amount">{{ number_format($subscription->amount, 0, ',', ' ') }} XOF</div>
                @if($subscription->paid_at)
                <div class="paid-date">
                    <i class="fas fa-calendar-day"></i> 
                    {{ \Carbon\Carbon::parse($subscription->paid_at)->format('d/m/Y H:i') }}

                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

@endsection