@extends('dashboard')
@section('title', 'Bog')
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
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-8">
            <!-- En-tête animé -->
            <div class="text-center mb-5 animate__animated animate__fadeInDown">
                <h1 class="display-4 fw-bold gradient-text mb-3">Rédiger un Nouvel Article</h1>
                <p class="lead text-muted">Partagez votre savoir avec la communauté étudiante ✨</p>
            </div>

            <!-- Formulaire -->
            <div class="card border-0 shadow-lg hover-shadow-lg transition-all">
                <div class="card-header bg-white py-4 border-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Blog</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nouvel article</li>
                        </ol>
                    </nav>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" id="postForm">
                        @csrf

                        <!-- Titre -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-danger mb-3">
                                <i class="bi bi-pencil-square me-2"></i>Titre de l'article
                            </label>
                            <div class="input-group">
                                <input 
                                    type="text" 
                                    name="title" 
                                    class="form-control form-control-lg border-danger @error('title') is-invalid @enderror" 
                                    placeholder="Écrivez un titre percutant..."
                                    required
                                    id="titleInput"
                                >
                                <span class="input-group-text bg-danger text-white border-danger">
                                    <i class="bi bi-type-h1"></i>
                                </span>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted float-end" id="titleCounter">0/70 caractères</small>
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-danger mb-3">
                                <i class="bi bi-image me-2"></i>Image mise en avant
                            </label>
                            <div class="image-upload-container border-2 border-dashed border-danger rounded-3 p-5 text-center"
                                 id="dropZone"
                                 ondrop="dropHandler(event)"
                                 ondragover="dragOverHandler(event)">
                                <input type="file" name="image" id="imageInput" class="d-none" accept="image/*" required>
                                <div id="uploadContent">
                                    <i class="bi bi-cloud-upload fs-1 text-danger mb-3"></i>
                                    <p class="mb-1">Glissez-déposez votre image ici</p>
                                    <p class="text-muted mb-3">ou</p>
                                    <button type="button" class="btn btn-outline-danger" onclick="document.getElementById('imageInput').click()">
                                        Choisir un fichier
                                    </button>
                                    <div class="mt-2 text-muted small">Formats supportés: JPG, PNG (max 2MB)</div>
                                </div>
                                <div class="image-preview mt-3" id="imagePreview"></div>
                            </div>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <div class="row g-3">
                                <!-- Catégorie -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-danger mb-3">
                                            <i class="bi bi-bookmarks me-2"></i>Catégorie
                                        </label>
                                        <div class="input-group has-validation">
                                            <select name="category" id="categorySelect" 
                                                class="form-select form-select-lg border-danger @error('category') is-invalid @enderror" 
                                                required
                                                x-data="{}"
                                                x-init="function() { new Choices($el, {
                                                    searchEnabled: true,
                                                    removeItemButton: true,
                                                    placeholderValue: 'Choisir une catégorie',
                                                    allowHTML: true
                                                })}">
                                                <option value="">Sélectionnez une catégorie</option>
                                                <option value="sante" data-icon="bi-heart-pulse">Santé étudiante</option>
                                                <option value="academique" data-icon="bi-journal-bookmark">Vie académique</option>
                                                <option value="emploi" data-icon="bi-briefcase">Opportunités d'emploi</option>
                                                <option value="culture" data-icon="bi-music-note-beamed">Culture & Loisirs</option>
                                                <option value="logement" data-icon="bi-house-door">Logement étudiant</option>
                                                <option value="evenements" data-icon="bi-calendar-event">Événements</option>
                                                <option value="technology" data-icon="bi-calendar-event">Technologie</option>

                                                <option value="autre" data-icon="bi-three-dots">Autre</option>
                                            </select>
                                            <span class="input-group-text bg-danger text-white border-danger">
                                                <i class="bi bi-diagram-3"></i>
                                            </span>
                                            @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted">Permet une meilleure classification</small>
                                    </div>
                                </div>
                        
                                <!-- Statut -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-danger mb-3">
                                            <i class="bi bi-toggle-on me-2"></i>Statut de publication
                                        </label>
                                        <div class="input-group has-validation">
                                            <select name="status" id="statusSelect" 
                                                class="form-select form-select-lg border-danger @error('status') is-invalid @enderror" 
                                                required
                                                x-data="{}"
                                                x-init="function() { new Choices($el, {
                                                    searchEnabled: false,
                                                    placeholder: false,
                                                    itemSelectText: ''
                                                })}">
                                                <option value="draft" data-icon="bi-file-earmark" selected>Brouillon</option>
                                                <option value="published" data-icon="bi-globe">Publié immédiatement</option>
                                                <option value="archived" data-icon="bi-archive">Archivé</option>
                                            </select>
                                            <span class="input-group-text bg-danger text-white border-danger">
                                                <i class="bi bi-eye"></i>
                                            </span>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Contenu -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-danger mb-3">
                                <i class="bi bi-body-text me-2"></i>Contenu de l'article
                            </label>
                            <textarea 
                                name="content" 
                                rows="8" 
                                class="form-control border-danger @error('content') is-invalid @enderror" 
                                placeholder="Commencez à rédiger votre contenu..."
                                required
                                id="contentInput"
                            ></textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="d-flex justify-content-between mt-2">
                                <small class="form-text text-muted">Markdown accepté</small>
                                <small class="form-text text-muted" id="contentCounter">0/2000 caractères</small>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-danger mb-3">
                                <i class="bi bi-tags me-2"></i>Mots-clés
                            </label>
                            <div class="tag-input-container">
                                <input 
                                    type="text" 
                                    class="form-control border-danger" 
                                    id="tagInput"
                                    placeholder="Ajoutez des tags (séparés par des virgules)"
                                >
                                <div class="tag-preview mt-2" id="tagPreview"></div>
                                <input type="hidden" name="tags" id="hiddenTags">
                            </div>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-lg btn-danger px-5 py-3 rounded-pill shadow-sm">
                                <i class="bi bi-send-check me-2"></i>Publier l'article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('extra-scripts')
<script>
    // Gestion de l'image
    function handleImageUpload(file) {
        const preview = document.getElementById('imagePreview');
        const reader = new FileReader();
    
        reader.onload = (e) => {
            preview.innerHTML = `<img src="${e.target.result}" class="img-fluid">`;
            preview.style.display = 'block';
            document.getElementById('uploadContent').style.display = 'none';
        };
    
        reader.readAsDataURL(file);
    }
    
    // Drag & drop
    function dragOverHandler(e) {
        e.preventDefault();
        document.getElementById('dropZone').classList.add('dragover');
    }
    
    function dropHandler(e) {
        e.preventDefault();
        document.getElementById('dropZone').classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        if (file) handleImageUpload(file);
    }
    
    document.getElementById('imageInput').addEventListener('change', (e) => {
        if (e.target.files[0]) handleImageUpload(e.target.files[0]);
    });
    
    // Compteurs de caractères
    document.getElementById('titleInput').addEventListener('input', (e) => {
        document.getElementById('titleCounter').textContent = `${e.target.value.length}/70`;
    });
    
    document.getElementById('contentInput').addEventListener('input', (e) => {
        document.getElementById('contentCounter').textContent = `${e.target.value.length}/2000`;
    });
    
    // Gestion des tags
    document.getElementById('tagInput').addEventListener('input', (e) => {
        const tags = e.target.value.split(',').map(tag => tag.trim()).filter(tag => tag);
        const preview = document.getElementById('tagPreview');
        preview.innerHTML = tags.map(tag => 
            `<span class="tag">#${tag}</span>`
        ).join('');
        document.getElementById('hiddenTags').value = tags.join(',');
    });
    </script>
    <script src="https://cdn.tiny.cloud/1/t40a2vy1t3kvif8uykya569m0q32gcscadunfjc11yysp33x/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#contentInput',
            plugins: 'link lists image code',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
            height: 400,
            content_style: 'body { font-family: Arial, sans-serif; font-size:16px }'
        });
    });
    </script>
@endsection