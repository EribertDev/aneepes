@extends('dashboard')
@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('extra-style')
<script src="https://cdn.tiny.cloud/1/t40a2vy1t3kvif8uykya569m0q32gcscadunfjc11yysp33x/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<style>
    .tox-tinymce {
    border-radius: 8px!important;
    margin-bottom: 1rem;
}

.tox-statusbar__text-container {
    display: none!important;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Créer une nouvelle actualité</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Titre</label>
                    <input type="text" name="title" class="form-control" value="{{ $news->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sous-titre</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ $news->subtitle }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="editor" class="form-control" rows="5" required>{{ $news->description }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select" required>
                            <option value="info">Information</option>
                            <option value="event">Événement</option>
                            <option value="alert">Alerte</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Statut</label>
                        <select name="status" class="form-select" required>
                            <option value="draft">Brouillon</option>
                            <option value="published">Publié</option>
                            <option value="archived">Archivé</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    @if($news->photo)
                        <img src="{{ Storage::url($news->photo) }}" alt="Photo de l'actualité" style="width: 100px;">
                    @endif
                    <input type="file" name="photo" class="form-control" accept="image/*" >
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection 
@section('extra-scripts')
<script src="https://cdn.tiny.cloud/1/t40a2vy1t3kvif8uykya569m0q32gcscadunfjc11yysp33x/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    tinymce.init({
        selector: '#editor',
        plugins: 'link lists image code',
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
        height: 400,
        content_style: 'body { font-family: Arial, sans-serif; font-size:16px }'
    });
});
</script>
@endsection