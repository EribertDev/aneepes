@extends('dashboard')
@section('title', 'Blog|E')
@section('extra-style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<style>
    
    .gradient-text {
        background: linear-gradient(45deg, #A12C2F, #D4AF37);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .image-upload-container {
        transition: all 0.3s ease;
        background: rgba(161, 44, 47, 0.05);
    }

    .image-upload-container.dragover {
        background: rgba(161, 44, 47, 0.1);
        border-style: solid !important;
    }

    .image-preview {
        display: none;
    }

    .image-preview img {
        max-height: 300px;
        object-fit: cover;
        border-radius: 0.5rem;
        border: 2px solid #A12C2F;
    }

    .tag-preview {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .tag {
        background: rgba(161, 44, 47, 0.1);
        color: #A12C2F;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.9em;
    }
    .current-image {
        border: 2px solid #A12C2F;
        border-radius: 0.5rem;
        padding: 0.25rem;
    }
    
    .form-control:focus {
        border-color: #A12C2F;
        box-shadow: 0 0 0 0.25rem rgba(161, 44, 47, 0.25);
    }
</style>
@endsection

@section('content')

div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <!-- En-tête -->
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-danger mb-3">Modifier l'article</h1>
                <p class="lead text-muted">Mettez à jour votre publication</p>
            </div>

            <!-- Carte d'édition -->
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-danger text-white py-3">
                    <h2 class="h5 mb-0">{{ Str::limit($post->title, 50) }}</h2>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Titre -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-danger">Titre</label>
                            <input type="text" 
                                   name="title" 
                                   class="form-control form-control-lg border-danger @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $post->title) }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-danger">Image mise en avant</label>
                            <div class="d-flex gap-4 align-items-center">
                                <div class="current-image">
                                    <img src="{{ Storage::url($post->image) }}" 
                                         alt="Image actuelle" 
                                         class="img-thumbnail rounded-3" 
                                         style="max-width: 200px;">
                                </div>
                                <div class="flex-grow-1">
                                    <input type="file" 
                                           name="image" 
                                           class="form-control border-danger @error('image') is-invalid @enderror">
                                    <small class="text-muted">Laisser vide pour conserver l'image actuelle</small>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Contenu -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-danger">Contenu</label>
                            <textarea name="content" 
                                        id="content"
                                      rows="10" 
                                      class="form-control border-danger @error('content') is-invalid @enderror" 
                                      required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Catégorie et Statut -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-danger">Catégorie</label>
                                <select name="category" class="form-select border-danger @error('category') is-invalid @enderror">
                                    @foreach(['technology', 'business', 'health', 'entertainment', 'emploi', 'culture', 'autre'] as $category)
                                        <option value="{{ $category }}" 
                                            {{ old('category', $post->category) === $category ? 'selected' : '' }}>
                                            {{ ucfirst($category) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-danger">Statut</label>
                                <select name="status" class="form-select border-danger @error('status') is-invalid @enderror">
                                    <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Brouillon</option>
                                    <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Publié</option>
                                    <option value="archived" {{ old('status', $post->status) === 'archived' ? 'selected' : '' }}>Archivé</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-danger">Mots-clés</label>
                            <input type="text" 
                                   name="tags" 
                                   class="form-control border-danger @error('tags') is-invalid @enderror" 
                                   value="{{ old('tags', implode(', ', $post->tags ?? [])) }}">
                            <small class="text-muted">Séparez les tags par des virgules</small>
                            @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <button type="submit" class="btn btn-danger btn-lg px-5">
                                <i class="bi bi-save me-2"></i>Enregistrer
                            </button>
                            
                            <button type="button" 
                                    class="btn btn-outline-danger" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal">
                                <i class="bi bi-trash me-2"></i>Supprimer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de suppression -->
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
    // Initialisation des tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
        <script src="https://cdn.tiny.cloud/1/t40a2vy1t3kvif8uykya569m0q32gcscadunfjc11yysp33x/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '#content',
                plugins: 'link lists image code',
                toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
                height: 400,
                content_style: 'body { font-family: Arial, sans-serif; font-size:16px }'
            });
        });
        </script>
@endsection