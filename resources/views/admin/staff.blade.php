@extends('dashboard')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('extra-style')
<style>
    .form-control:invalid, .form-select:invalid {
    border-color: #dc3545;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.form-control:valid, .form-select:valid {
    border-color: #198754;
    background-repeat: no-repeat;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.invalid-feedback {
    display: none;
}

.is-invalid ~ .invalid-feedback {
    display: block;
}
.modal-header{
    background-color: #A12C2F;
}
    .modal-content {
        border-radius: 1rem;
        overflow: hidden;
    }

    
    .form-control-lg {
        padding: 0.75rem 1.5rem;
    }
    
    .rounded-pill {
        border-radius: 50rem !important;
    }
    
    .bg-light-success {
        background-color: #d1e7dd;
    }
    
    .toast {
        border-radius: 0.5rem;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.1);
    }
    </style>
@endsection
@section('content')
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
    <i class="fas fa-user-plus me-2"></i>Nouvel utilisateur 
</button>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-[#A12C2F] ">
                <h5 class="modal-title" id="userModalLabel">
                    <i class="fas fa-user-shield me-2"></i>Nouvel utilisateur
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" id="userForm">
                @csrf
                <div class="modal-body">
                    <!-- Nom -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom complet</label>
                        <input type="text" 
                               class="form-control" 
                               id="name" 
                               name="name"
                               pattern=".{3,}"
                               required>
                        <div class="invalid-feedback">Minimum 3 caractères requis</div>
                    </div>
        
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email"
                               required>
                        <div class="invalid-feedback">Format email invalide</div>
                    </div>
        
                    <!-- Téléphone -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="tel" 
                               class="form-control" 
                               id="phone" 
                               name="phone"
                               pattern="[0-9]{10}"
                               required>
                        <div class="invalid-feedback">Numéro à 10 chiffres requis</div>
                    </div>
        
                    <!-- Avatar -->
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Photo de profil</label>
                        <input type="file" 
                               class="form-control" 
                               id="avatar" 
                               name="avatar"
                               accept="image/*"
                               required>
                        <div class="invalid-feedback">Format d'image valide requis</div>
                    </div>
        
                    <!-- Rôle -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle</label>
                        <select class="form-select" 
                                id="role" 
                                name="role" 
                                required>
                            <option value="">Sélectionner un rôle</option>
                            <option value="admin">Administrateur</option>
                            <option value="editor">Éditeur</option>
                        </select>
                        <div class="invalid-feedback">Veuillez sélectionner un rôle</div>
                    </div>
        
                    <!-- Mot de passe -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" 
                               class="form-control" 
                               id="password" 
                               name="password"
                               minlength="8"
                               required>
                        <div class="invalid-feedback">Minimum 8 caractères</div>
                    </div>
        
                    <!-- Confirmation -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmation</label>
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation"
                               required>
                        <div class="invalid-feedback">Doit correspondre au mot de passe</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                        Créer l'utilisateur
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toast de succès -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <i class="fas fa-check-circle me-2"></i>
            <strong class="me-auto">Succès</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-light-success">
            {{ session('success') }}
        </div>
    </div>
</div>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="failedToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white">
            <i class="fas fa-check-circle me-2"></i>
            <strong class="me-auto">Echec</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-light-danger">
            {{ session('failed') }}
        </div>
    </div>
</div>

@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toast = new bootstrap.Toast(document.getElementById('successToast'));
    toast.show();
    
    // Fermer automatiquement après 5 secondes
    setTimeout(() => {
        toast.hide();
    }, 5000);
});
</script>
@elseif(session('failed'))

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toast = new bootstrap.Toast(document.getElementById('failedToast'));
    toast.show();
    
    // Fermer automatiquement après 5 secondes
    setTimeout(() => {
        toast.hide();
    }, 5000);
});
</script>


@endif


@endsection

@section('extra-script')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('userForm');
    const submitBtn = document.getElementById('submitBtn');
    const inputs = form.querySelectorAll('input, select');
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');

    // Validation générique
    function validateField(field) {
        const isValid = field.checkValidity();
        field.classList.toggle('is-invalid', !isValid);
        return isValid;
    }

    // Validation spécifique mot de passe
    function validatePassword() {
        const isValid = password.value === passwordConfirmation.value;
        passwordConfirmation.classList.toggle('is-invalid', !isValid);
        return isValid;
    }

    // Validation avatar
    function validateAvatar() {
        const file = document.getElementById('avatar').files[0];
        const isValid = file && file.type.startsWith('image/');
        document.getElementById('avatar').classList.toggle('is-invalid', !isValid);
        return isValid;
    }

    // Validation globale
    function validateForm() {
        let allValid = true;
        
        inputs.forEach(input => {
            if (input.id !== 'password_confirmation') {
                allValid = validateField(input) && allValid;
            }
        });

        allValid = validatePassword() && allValid;
        allValid = validateAvatar() && allValid;

        submitBtn.disabled = !allValid;
    }

    // Écouteurs d'événements
    inputs.forEach(input => {
        input.addEventListener('input', validateForm);
        input.addEventListener('blur', validateForm);
    });

    document.getElementById('avatar').addEventListener('change', validateForm);
    passwordConfirmation.addEventListener('input', validateForm);

    // Gestion de la soumission
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        submitBtn.disabled = true;
        submitBtn.querySelector('.spinner-border').classList.remove('d-none');
        
        // Simuler l'envoi AJAX
        setTimeout(() => {
            form.submit();
        }, 1000);
    });
});
</script>
@endsection