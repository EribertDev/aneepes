@extends('dashboard')
@section('title', ' Event')
@section('extra-style')
<style>
    .table-hover tbody tr:hover {
        background-color: rgba(161, 44, 47, 0.05);
    }
    
    .img-thumbnail {
        border-radius: 8px;
        border: 1px solid #dee2e6;
    }
    
    .badge {
        font-size: 0.85em;
        padding: 0.5em 0.75em;
    }
    </style>
@endsection

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center text-primary">Événements ANEEPES</h1>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="container-fluid px-4">
    <h1 class="mt-4">Gestion des Événements</h1>
    
    <div class="card mb-4 shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Liste des Événements</h5>
                <a href="{{ route('events.create') }}" class="btn btn-light">
                    <i class="fas fa-plus me-2"></i>Nouvel Événement
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Filtres -->
            <div class="row mb-4 g-3">
                <div class="col-md-3">
                    <select class="form-select" id="filter-status">
                        <option value="">Tous les statuts</option>
                        <option value="a_venir">À venir</option>
                        <option value="termine">Terminé</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="filter-type">
                        <option value="">Tous les types</option>
                        <option value="conference">Conférence</option>
                        <option value="atelier">Atelier</option>
                        <option value="seminaire">Séminaire</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Rechercher..." id="search-input">
                </div>
            </div>

            <!-- Tableau -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                        <tr>
                            <td style="width: 100px;">
                                <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/default-event.jpg') }}" 
                                     class="img-thumbnail" 
                                     alt="{{ $event->titre }}"
                                     style="width: 80px; height: 60px; object-fit: cover;">
                            </td>
                            <td>{{ $event->titre }}</td>
                            <td>{{ $event->date_heure->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge bg-{{ $event->statut === 'a_venir' ? 'success' : 'secondary' }}">
                                    {{ $event->statut === 'a_venir' ? 'À venir' : 'Terminé' }}
                                </span>
                            </td>
                            <td>{{ ucfirst($event->type) }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('events.edit', $event->id) }}" 
                                       class="btn btn-sm btn-primary"
                                       data-bs-toggle="tooltip"
                                       title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger"
                                                data-bs-toggle="tooltip"
                                                title="Supprimer"
                                                onclick="return confirm('Confirmer la suppression ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <a href="{{ route('events.show', $event->id) }}" 
                                       class="btn btn-sm btn-info"
                                       data-bs-toggle="tooltip"
                                       title="Voir public"
                                       target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Aucun événement trouvé</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-end">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</div>


@endsection
@section('extra-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filtrage côté client (ou implémenter le filtrage côté serveur)
        const filterTable = () => {
            const status = document.getElementById('filter-status').value.toLowerCase();
            const type = document.getElementById('filter-type').value.toLowerCase();
            const search = document.getElementById('search-input').value.toLowerCase();
            
            document.querySelectorAll('tbody tr').forEach(row => {
                const rowStatus = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                const rowType = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                const rowText = row.textContent.toLowerCase();
                
                const statusMatch = !status || rowStatus.includes(status);
                const typeMatch = !type || rowType.includes(type);
                const searchMatch = rowText.includes(search);
                
                row.style.display = (statusMatch && typeMatch && searchMatch) ? '' : 'none';
            });
        };
    
        document.querySelectorAll('#filter-status, #filter-type, #search-input').forEach(el => {
            el.addEventListener('change', filterTable);
            el.addEventListener('keyup', filterTable);
        });
    
        // Activer les tooltips Bootstrap
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    });
    </script>
    
@endsection