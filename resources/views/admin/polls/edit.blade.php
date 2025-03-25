@extends('dashboard')
@section('title', 'Create Event')
@section('extra-style')
<style>
    :root {
  --anepes-red: #A12C2F;
  --anepes-gold: #D4AF37;
  --anepes-dark-red: #8A2326;
  --anepes-beige: #F5F0E6;
  --anepes-black: #2D2D2D;
}
  </style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-anepes-red">
                {{ isset($poll) ? 'Éditer le Sondage' : 'Créer un Nouveau Sondage' }}
            </h6>
        </div>
        <div class="card-body">
            <form method="POST" 
                  action="{{route('admin.polls.update',$poll->id)}}" >
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label">Question du sondage</label>
                    <input type="text" 
                           name="question" 
                           class="form-control"
                           value="{{ old('question', $poll->question ?? '') }}"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Options de réponse</label>
                    <div id="options-container">
                        @foreach(old('options', isset($poll) ? $poll->options : ['', '']) as $index => $option)
                        <div class="input-group mb-2 option-row">
                            <input type="text" 
                                   name="options[{{ $index }}][text]" 
                                   class="form-control"
                                       value="{{ is_array($option) ? $option['text'] : (is_object($option) ? $option->text : $option) }}"
                                   required>
                            @if(isset($poll) && isset($option->id))
                                <input type="hidden" 
                                       name="options[{{ $index }}][id]" 
                                       value="{{ $option->id }}">
                            @endif
                            @if($index > 1)
                                <button type="button" 
                                        class="btn btn-danger remove-option">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </div>
                    @endforeach
                    </div>
                    <button type="button" id="add-option" class="btn btn-gold mt-2">
                        <i class="fas fa-plus"></i> Ajouter une option
                    </button>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Statut</label>
                        <select name="status" class="form-select">
                            <option value="draft"  >
                                Brouillon
                            </option>
                            <option value="active" >
                                Actif
                            </option>
                            @isset($poll)
                            <option value="closed" >
                                Clôturé
                            </option>
                            @endisset
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">Date de fin (optionnel)</label>
                        <input type="datetime-local" 
                               name="end_at" 
                               class="form-control"
                               value="">
                    </div>

                    <div class="col-md-4">
                        <div class="form-check form-switch mt-4 pt-2">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="is_public"
                                   id="is_public"
                                   value="1"
                                   {{ old('is_public', isset($poll) ? $poll->is_public : true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_public">
                                Sondage public
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-anepes-red">
                    {{ isset($poll) ? 'Mettre à jour' : 'Créer le sondage' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('options-container');
    const addButton = document.getElementById('add-option');
    let optionCount = {{ count(old('options', isset($poll) ? $poll->options : ['', ''])) }};

    addButton.addEventListener('click', function() {
        const newRow = document.createElement('div');
        newRow.className = 'input-group mb-2 option-row';
        newRow.innerHTML = `
            <input type="text" 
                   name="options[${optionCount}][text]" 
                   class="form-control" 
                   required>
            <button type="button" class="btn btn-danger remove-option">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(newRow);
        optionCount++;
    });

    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-option')) {
            if (container.querySelectorAll('.option-row').length > 2) {
                e.target.closest('.option-row').remove();
            }
        }
    });
});
</script>

@endsection