@extends('dashboard')

@section('title', 'Membres')
@section('page-title','Membres' )
@section('extra-style')

<style>
    /* Style personnalisé pour le modal */
    #userModal .modal-content {
        border: 2px solid #D4AF37;
        border-radius: 10px;
        overflow: hidden;
    }
    
    #userModal .form-control, 
    #userModal .form-select {
        border-radius: 5px;
        border: 1px solid #ddd;
        padding: 10px;
    }
    
    #userModal .form-control:focus, 
    #userModal .form-select:focus {
        border-color: #A12C2F;
        box-shadow: 0 0 0 0.25rem rgba(161, 44, 47, 0.25);
    }
    
    #userModal .form-check-input:checked {
        background-color: #A12C2F;
        border-color: #A12C2F;
    }
    
    #userModal .btn-primary:hover {
        background-color: #8a1f28 !important;
        border-color: #8a1f28 !important;
    }

    .table-hover tbody tr:hover {
    transform: scale(1.01);
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    transition: all 0.2s ease;
}

.badge {
    font-size: 0.85em;
    padding: 0.35em 0.65em;
}

.btn-sm {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}
    </style>
@endsection


@section('content')

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
    <i class="fas fa-user-plus me-2"></i>Nouveau Membre
</button>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Photo</th>
                <th>Nom complet</th>
                <th>Rôle</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>
                    @if($member->photo)
                    <img src="{{ $member->photo ? Storage::url($member->photo) : asset('default-avatar.png') }}" alt="{{ $member->fullname }}"
                         class="rounded-circle" width="50" height="50" style="object-fit: cover;">
                    @else
                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" 
                         style="width: 50px; height: 50px;">
                        <span class="text-white">{{ substr($member->fullname, 0, 1) }}</span>
                    </div>
                    @endif
                </td>
                <td>{{ $member->fullname }}</td>
                <td>
                    <span class="badge 
                        @if($member->role === 'Président') bg-primary
                        @elseif($member->role === 'Vice-Président') bg-info
                        @elseif($member->role === 'Secrétaire') bg-success
                        @elseif($member->role === 'Trésorier') bg-warning
                        @else bg-secondary
                        @endif">
                        {{ $member->role }}
                    </span>
                </td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->phone }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-primary" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editMemberModal"
                                data-member-id="{{ $member->id }}"
                                data-edit-url="{{ route('members.edit', $member->id) }}"
                                data-update-url="{{ route('members.update', $member->id) }}">
                            <i class="bi bi-pencil"></i>
                        </button>
     
                        
                        <button class="btn btn-sm btn-outline-danger delete-member" 
                                data-id="{{ $member->id }}" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteMemberModal"
                                data-member-id="{{ $member->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                      
                        <button class="btn btn-sm toggle-visibility-btn 
                        @if($member->is_visible) btn-success @else btn-secondary @endif"
                        data-member-id="{{ $member->id }}">
                    <i class="bi @if($member->is_visible) bi-eye-fill @else bi-eye-slash-fill @endif"></i>
                </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



<!--Modal des membres -->
<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #A12C2F; color: white;">
                <h5 class="modal-title" id="userModalLabel">
                    <i class="fas fa-user-plus me-2"></i>Ajouter un nouveau membre
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addMemberForm" method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Colonne gauche -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Nom complet</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                        </div>

                        <!-- Colonne droite -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role" class="form-label">Rôle</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="">Sélectionner un rôle</option>
                                    <option value="Président">Président</option>
                                    <option value="Vice-Président">Vice-Président</option>
                                    <option value="Secrétaire">Secrétaire</option>
                                    <option value="Trésorier">Trésorier</option>
                                    <option value="Membre">Membre</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo de profil</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                            </div>

                            <div class="form-check form-switch mb-3">
                                
                                <input class="form-check-input" 
                                type="checkbox" 
                                id="is_visible"
                                name="is_visible"
                                value="1"
                                {{ old('is_visible') ? 'checked' : '' }}
                              >
                              <input type="hidden" name="is_visible" id="is_visible" value="0">
                                <label class="form-check-label" for="is_visible">Visible sur le site</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 2px solid #D4AF37;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-primary" style="background-color: #A12C2F; border-color: #A12C2F;">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

 <!--Fin du modal -->



 
    
 @include('admin.modals.editMembers')

@endsection





@section('extra-scripts')

<script>
    // Initialisation du formulaire avec validation
    document.getElementById('addMemberForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    formData.set('is_visible', this.querySelector('#is_visible').checked ? '1' : '0');

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json' // Demande explicitement du JSON
        }
    })
    .then(async response => {
        const text = await response.text();
        try {
            const data = JSON.parse(text);
            if (!response.ok) {
                throw new Error(data.message || 'Erreur serveur');
            }
            return data;
        } catch {
            throw new Error(`Réponse invalide: ${text.substring(0, 100)}`);
        }
    })
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('userModal')).hide();
            window.location.reload();
        } else {
            alert('Erreur: ' + (data.message || 'Action échouée'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur: ' + error.message);
    })
    .finally(() => {
        submitBtn.disabled = false;
    });

});



// Suppression d'un membre
document.querySelectorAll('.delete-member').forEach(btn => {
    btn.addEventListener('click', function() {
        if (confirm('Voulez-vous vraiment supprimer ce membre ?')) {
            fetch(`/members/${this.dataset.id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                   alert('Suppression éffectué');
                   //window.location.reload();
                }
            });
        }
    });
});
</script>



@endsection