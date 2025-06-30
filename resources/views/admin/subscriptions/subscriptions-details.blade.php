@extends('dashboard')
@section('title', 'Subscription')
@section('page-title', 'Subscription')
@section('extra-style')
 <style>
        :root {
            --primary-color: #A12C2F;
            --accent-color: #D4AF37;
            --dark-color: #2c3e50;
            --light-color: #f8f9fa;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
       
        
        .content-area {
            padding: 2rem;
        }
        
        .page-title {
            color: var(--primary-color);
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 2rem;
        }
        
        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 70px;
            height: 3px;
            background: var(--accent-color);
        }
        
        .stats-card {
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .stats-card .card-header {
            background: white;
            color: var(--primary-color);
            font-weight: 600;
            border: none;
            padding: 1rem 1.5rem;
        }
        
        .stats-card .card-body {
            padding: 1.5rem;
        }
        
        .stats-number {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .table-header {
            background: var(--primary-color);
            color: white;
            padding: 1.2rem 1.5rem;
        }
        
        .payment-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .payment-table thead th {
            background: #f8f9fa;
            color: var(--dark-color);
            font-weight: 600;
            padding: 1rem 1.5rem;
            border-bottom: 2px solid #e9ecef;
        }
        
        .payment-table tbody td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }
        
        .payment-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .payment-table tbody tr:hover {
            background-color: rgba(161, 44, 47, 0.03);
        }
        
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }
        
        .status-paid {
            background: rgba(40, 167, 69, 0.15);
            color: var(--success-color);
        }
        
        .status-pending {
            background: rgba(255, 193, 7, 0.15);
            color: var(--warning-color);
        }
        
        .status-failed {
            background: rgba(220, 53, 69, 0.15);
            color: var(--danger-color);
        }
        
        .month-filter {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }
        
        .month-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .btn-gold {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-gold:hover {
            background: #c9a227;
            transform: translateY(-2px);
            color: white;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
            background: var(--accent-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .pagination .page-item .page-link {
            color: var(--primary-color);
        }
        
        .pagination .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }
    </style>
@endsection


@section('content')

  

    <div class="container-fluid">
        <div class="row">
         

            <!-- Contenu principal -->
            <main class=" content-area">
                <h2 class="page-title">
                    <i class="fas fa-money-check-alt me-3"></i>Gestion des Cotisations
                </h2>
                
                <!-- Cartes de statistiques -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-card">
                            <div class="card-header">
                                <i class="fas fa-check-circle me-2"></i>Payées ce mois
                            </div>
                            <div class="card-body">
                                <div class="stats-number text-success">{{ $paid }}</div>
                                <div class="stats-label">Cotisations réglées</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stats-card">
                            <div class="card-header">
                                <i class="fas fa-clock me-2"></i>En attente
                            </div>
                            <div class="card-body">
                                <div class="stats-number text-warning">{{ $pending }}</div>
                                <div class="stats-label">Paiements en cours</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stats-card">
                            <div class="card-header">
                                <i class="fas fa-exclamation-triangle me-2"></i>Non payées
                            </div>
                            <div class="card-body">
                                <div class="stats-number text-danger">{{ $failed }}</div>
                                <div class="stats-label">Cotisations manquantes</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Filtres -->
                <div class="month-filter">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h3 class="month-title mb-0">
                                <i class="fas fa-calendar-alt me-2"></i>{{ date('F Y') }} - Détails des cotisations
                            </h3>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="d-flex justify-content-md-end gap-2">
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-filter me-2"></i>Filtrer par statut
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Tous</a></li>
                                        <li><a class="dropdown-item" href="#">Payées</a></li>
                                        <li><a class="dropdown-item" href="#">En attente</a></li>
                                        <li><a class="dropdown-item" href="#">Non payées</a></li>
                                    </ul>
                                </div>
                                <button class="btn-gold">
                                    <i class="fas fa-download me-2"></i>Exporter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tableau des paiements -->
                <div class="table-container">
                    <div class="table-header">
                        <h3 class="h5 mb-0">
                            <i class="fas fa-list me-2"></i>Détail des Cotisations
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="payment-table">
                            <thead>
                                <tr>
                                    <th>Membre</th>
                                    <th>Mois</th>
                                    <th>Montant</th>
                                    <th>Date de paiement</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Ligne 1 -->
                            @foreach($payments as $payment)
                                <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            {{ substr($payment->user->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="fw-medium">{{ $payment->user->name }}</div>
                                            <div class="small text-muted">{{ $payment->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($payment->month)->format('F Y') }}</td>
                                <td class="fw-bold">{{ number_format($payment->amount, 0, ',', ' ') }} FCFA</td>
                                <td>
                                    @if($payment->paid_at)
                                        {{ \Carbon\Carbon::parse($payment->paid_at)->format('d/m/Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($payment->status === 'paid')
                                        <span class="status-badge status-paid">
                                            <i class="fas fa-check-circle me-1"></i>Payée
                                        </span>
                                    @elseif($payment->status === 'pending')
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-clock me-1"></i>En attente
                                        </span>
                                    @else
                                        <span class="status-badge status-failed">
                                            <i class="fas fa-times-circle me-1"></i>Échouée
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Actions -->
                                </td>
                                </tr>
                            @endforeach
                    
               
                     
                    </nav>
                </div>
            </main>
        </div>
    </div>

@endsection