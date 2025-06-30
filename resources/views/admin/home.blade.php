@extends('dashboard')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('extra-style')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .header-dashboard {
        background: linear-gradient(45deg, #A12C2F, #D4AF37);
    }

    .stat-card {
        transition: transform 0.3s ease;
        border: none;
        overflow: hidden;   
    }

    .hover-scale:hover {
        transform: translateY(-5px);
    }       

    .bg-gold-gradient {
        background: linear-gradient(45deg, #D4AF37, #c19b30);
    }

    .bg-red-gradient {
        background: linear-gradient(45deg, #A12C2F, #8a2326);
    }

    .hover-bg:hover {
        background: rgba(161, 44, 47, 0.05) !important;
    }

    .activity-item {
        display: flex;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid #eee;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .btn-gold {
        background: #D4AF37;
        color: white;
        border: none;
    }

    .btn-gold:hover {
        background: #b5952f;
        color: white;
    }
</style>

@endsection
@section('content')
<div class="container-fluid px-4">
    <!-- En-tête -->
    <div class="header-dashboard bg-danger text-white rounded-3 p-4 mb-4 shadow-lg">
        <h1 class="h2 mb-0">Tableau de bord ANEPES</h1>
        <p class="mb-0">Bienvenue, {{ auth()->user()->name }}</p>
    </div>

    <!-- Cartes de statistiques -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card bg-gold-gradient text-white hover-scale">
                <div class="card-body">
                    <i class="bi bi-people fs-1"></i>
                    <h2 class="mb-0"> {{ $totalUsers}} </h2>
                    <small>Étudiants inscrits</small>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card bg-red-gradient text-white hover-scale">
                <div class="card-body">
                    <i class="bi bi-calendar-event fs-1"></i>
                    <h2 class="mb-0"> {{ $upcomingEvents}} </h2>
                    <small>Événements à venir</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card bg-dark text-white hover-scale">
                <div class="card-body">
                    <i class="bi bi-file-post fs-1"></i>
                    <h2 class="mb-0"> {{$pendingCount}} </h2>
                    <small>Publications en attente</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card bg-primary text-white hover-scale">
                <div class="card-body">
                    <i class="bi bi-clock-history fs-1"></i>
                    <h2 class="mb-0"> {{ $newRegistrationsWeek}} </h2>
                    <small>Nouvelles inscriptions (7 derniers jours)</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Section principale -->
    <div class="row g-4">
        <!-- Colonne gauche -->
        <div class="col-xl-8">
            <!-- Graphiques -->
          

            <!-- Dernières inscriptions -->
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Dernières inscriptions</h5>
                    <a href="{{ route('staff') }}" class="btn btn-sm btn-danger">Voir tout</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Inscription</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUsers as $user)
                                <tr class="hover-bg">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td><span class="badge bg-success">Actif</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne droite -->
        <div class="col-xl-4">
            <!-- Actions rapides -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Actions rapides</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-danger">
                            <i class="bi bi-plus-circle me-2"></i>Nouvel article
                        </a>
                        <a href="{{ route('events.create') }}" class="btn btn-gold">
                            <i class="bi bi-calendar-plus me-2"></i>Créer un événement
                        </a>
                        <a href="{{ route('admin.polls.index') }}" class="btn btn-dark">
                            <i class="bi bi-bar-chart me-2"></i>Gérer les sondages
                        </a>
                    </div>
                </div>
            </div>

         
    </div>
</div>
@endsection

@section('extra-script')
<script>

</script>

@endsection