@extends('dashboard')
@section('title', 'Edit Event')
@section('extra-style')
@endsection

@section('content')
<div class="container-fluid px-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Modifier l'événement</h2>
        </div>
        
        <div class="card-body">
            <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Titre -->
                <div class="mb-4">
                    <label class="form-label">Titre</label>
                    <input type="text" 
                           name="titre" 
                           class="form-control @error('titre') is-invalid @enderror" 
                           value="{{ old('titre', $event->titre) }}"
                           required>
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="form-label">Description</label>
                    <textarea name="description" 
                              class="form-control @error('description') is-invalid @enderror" 
                              rows="5"
                              required>{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-4">
                    <!-- Lieu -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Lieu</label>
                            <input type="text" 
                                   name="lieu" 
                                   class="form-control @error('lieu') is-invalid @enderror" 
                                   value="{{ old('lieu', $event->lieu) }}"
                                   required>
                            @error('lieu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Date et Heure -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Date et Heure</label>
                            <input type="datetime-local" 
                                   name="date_heure" 
                                   class="form-control @error('date_heure') is-invalid @enderror" 
                                   value="{{ old('date_heure', $event->date_heure->format('Y-m-d\TH:i')) }}"
                                   required>
                            @error('date_heure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Statut -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Statut</label>
                            <select name="statut" 
                                    class="form-select @error('statut') is-invalid @enderror"
                                    required>
                                <option value="a_venir" {{ old('statut', $event->statut) === 'a_venir' ? 'selected' : '' }}>À venir</option>
                                <option value="termine" {{ old('statut', $event->statut) === 'termine' ? 'selected' : '' }}>Terminé</option>
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Type -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Type</label>
                            <select name="type" 
                                    class="form-select @error('type') is-invalid @enderror"
                                    required>
                                <option value="conference" {{ old('type', $event->type) === 'conference' ? 'selected' : '' }}>Conférence</option>
                                <option value="atelier" {{ old('type', $event->type) === 'atelier' ? 'selected' : '' }}>Atelier</option>
                                <option value="seminaire" {{ old('type', $event->type) === 'seminaire' ? 'selected' : '' }}>Séminaire</option>
                                <option value="autre" {{ old('type', $event->type) === 'autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="mb-4">
                    <label class="form-label">Image de couverture</label>
                    <input type="file" 
                           name="image" 
                           class="form-control @error('image') is-invalid @enderror"
                           accept="image/*"
                           id="imageInput">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    @if($event->image)
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $event->image) }}" 
                             class="img-thumbnail" 
                             style="max-height: 200px;"
                             alt="Image actuelle">
                        <div class="form-check mt-2">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="remove_image" 
                                   id="removeImage">
                            <label class="form-check-label text-danger" for="removeImage">
                                Supprimer l'image actuelle
                            </label>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save me-2"></i>Mettre à jour
                    </button>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@section('extra-scripts')
<script>
    // Aperçu de la nouvelle image
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if(!preview) {
                    preview = document.createElement('img');
                    preview.id = 'imagePreview';
                    preview.className = 'img-thumbnail mt-3';
                    preview.style.maxHeight = '200px';
                    document.querySelector('#imageInput').parentNode.appendChild(preview);
                }
                preview.src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    </script>
@endsection