@extends('dashboard')
@section('title', 'Create Event')
@section('extra-style')
@endsection

@section('content')

<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Créer un nouvel événement</h2>
        </div>
        
        <div class="card-body">
            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Titre -->
                <div class="mb-4">
                    <label class="form-label">Titre de l'événement</label>
                    <input type="text" 
                           name="titre" 
                           class="form-control @error('titre') is-invalid @enderror" 
                           value="{{ old('titre') }}"
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
                              required
                              >{{ old('description') }}</textarea>
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
                                   value="{{ old('lieu') }}"
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
                                   value="{{ old('date_heure') }}"
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
                                <option value="a_venir" {{ old('statut') == 'a_venir' ? 'selected' : '' }}>À venir</option>
                                <option value="termine" {{ old('statut') == 'termine' ? 'selected' : '' }}>Terminé</option>
                                <option value="termine" {{ old('statut') == 'annule' ? 'selected' : '' }}>Annulé</option>

                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Type -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Type d'événement</label>
                            <select name="type" 
                                    class="form-select @error('type') is-invalid @enderror"
                                    required>
                                <option value="conference" {{ old('type') == 'conference' ? 'selected' : '' }}>Conférence</option>
                                <option value="atelier" {{ old('type') == 'atelier' ? 'selected' : '' }}>Atelier</option>
                                <option value="seminaire" {{ old('type') == 'seminaire' ? 'selected' : '' }}>Séminaire</option>
                                <option value="autre" {{ old('type') == 'autre' ? 'selected' : '' }}>Autre</option>
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
                    <div class="mt-2">
                        <img id="imagePreview" 
                             src="#" 
                             alt="Aperçu de l'image" 
                             class="img-fluid rounded-3 d-none"
                             style="max-height: 200px;">
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save me-2"></i>Créer l'événement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('extra-scripts')

<script>
    // Aperçu de l'image
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            preview.src = "#";
            preview.classList.add('d-none');
        }
    });

 
    </script>
@endsection