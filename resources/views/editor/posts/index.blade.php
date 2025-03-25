@extends('dashboard')
@section('page-title', 'Blog')
@section('extra-style')
<style>
.post-thumbnail {
    width: 60px;
    height: 40px;
    object-fit: cover;
}

.status-badge {
    padding: 0.5rem 0.8rem;
    border-radius: 20px;
}

.status-badge.published {
    background: rgba(25, 135, 84, 0.15);
    color: #198754;
}

.status-badge.draft {
    background: rgba(255, 193, 7, 0.15);
    color: #ffc107;
}

.status-badge.archived {
    background: rgba(108, 117, 125, 0.15);
    color: #6c757d;
}

.hover-highlight:hover {
    background: rgba(161, 44, 47, 0.05) !important;
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
    <div class="row my-4">
        <div class="col-12">
            <!-- En-tête avec statistiques -->
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <h2 class="h4 mb-0">
                        <i class="bi bi-newspaper me-2"></i>Mes Publications
                    </h2>
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-gold">
                        <i class="bi bi-plus-circle me-2"></i>Nouvel Article
                    </a>
                </div>
                
                <div class="card-body bg-light">
                    <!-- Barre de contrôle -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Rechercher...">
                                <button class="btn btn-danger">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex justify-content-end gap-2">
                                <select class="form-select w-auto">
                                    <option>Tous les statuts</option>
                                    <option>Publié</option>
                                    <option>Brouillon</option>
                                    <option>Archivé</option>
                                </select>
                                <select class="form-select w-auto">
                                    <option>Trier par date</option>
                                    <option>Plus récent</option>
                                    <option>Plus ancien</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Tableau des articles -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th>Titre</th>
                                    <th class="text-center">Statut</th>
                                    <th>Date de publication</th>
                                    <th class="text-center">Stats</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr class="hover-highlight">
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ Storage::url($post->image) }}" 
                                                 alt="Miniature" 
                                                 class="post-thumbnail rounded">
                                            <div>
                                                <h6 class="mb-0">{{ Str::limit($post->title, 40) }}</h6>
                                                <small class="text-muted">
                                                    Mise à jour : {{ $post->updated_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="text-center">
                                        <span class="badge status-badge {{ $post->status }}">
                                            @if($post->status === 'published')
                                                <i class="bi bi-check-circle me-1"></i>Publié
                                            @elseif($post->status === 'draft')
                                                <i class="bi bi-pencil-square me-1"></i>Brouillon
                                            @else
                                                <i class="bi bi-archive me-1"></i>Archivé
                                            @endif
                                        </span>
                                    </td>
                                    
                                    <td>
                                        {{ $post->publication_date->format('d/m/Y H:i') }}
                                    </td>
                                    
                                    <td class="text-center">
                                        <div class="small-stats">
                                            <span class="text-danger">
                                                <i class="bi bi-eye"></i> 1.2k
                                            </span>
                                            <span class="mx-2">|</span>
                                            <span class="text-gold">
                                                <i class="bi bi-chat"></i> 45
                                            </span>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.posts.edit', $post) }}" 
                                               class="btn btn-sm btn-outline-danger"
                                               data-bs-toggle="tooltip" 
                                               title="Modifier">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            
                                      
                                            
                                            <button type="button" 
                                            class="btn btn-outline-danger" 
                                            target="_blank"
                                            data-bs-toggle="tooltip" 
                                            title="Supprimer"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal">
                                        <i class="bi bi-trash me-2"></i>
                                        </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-end mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>





    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer définitivement cet article ?
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Confirmer</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra-scripts')
<script>
    // Activation des tooltips Bootstrap
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection 
