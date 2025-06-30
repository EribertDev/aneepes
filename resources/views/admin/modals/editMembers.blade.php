<div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #A12C2F; color: white;">
                <h5 class="modal-title" id="editMemberModalLabel">
                    <i class="fas fa-user-edit me-2"></i>Modifier le membre
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editMemberForm" method="POST" action="{{ route('members.update', $member->id ?? '')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Colonne gauche -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_fullname" class="form-label">Nom complet</label>
                                <input type="text" class="form-control" id="edit_fullname" name="fullname" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_phone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" id="edit_phone" name="phone" required>
                            </div>
                        </div>

                        <!-- Colonne droite -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_role" class="form-label">Rôle</label>
                                <select class="form-select" id="edit_role" name="role" required>
                                    <option value="Président">Président</option>
                                    <option value="Vice-Président">Vice-Président</option>
                                    <option value="Secrétaire">Secrétaire</option>
                                    <option value="Trésorier">Trésorier</option>
                                    <option value="Membre">Membre</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit_photo" class="form-label">Photo de profil</label>
                                <input type="file" class="form-control" id="edit_photo" name="photo" accept="image/*">
                                <div class="mt-2" id="currentPhotoContainer"></div>
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="edit_is_visible" name="is_visible" value="1">
                               
                                <label class="form-check-label" for="edit_is_visible">Visible sur le site</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 2px solid #D4AF37;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Annuler
                    </button>
                    <button type="submit" id="submitBtn" class="btn btn-primary" style="background-color: #A12C2F; border-color: #A12C2F;">
                        <i class="fas fa-save me-2"></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Script pour remplir le modal d'édition
document.addEventListener('DOMContentLoaded', function() {
    const submitBtn = document.getElementById('submitBtn');
    const editModal = document.getElementById('editMemberModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const memberId = button.getAttribute('data-member-id');
            
            // Récupérer les données du membre via AJAX
            fetch(`/members/${memberId}/edit`)
                .then(response => response.json())
                .then(member => {
                    document.getElementById('editMemberForm').action = `/members/${member.id}`;
                    document.getElementById('edit_fullname').value = member.fullname;
                    document.getElementById('edit_email').value = member.email;
                    document.getElementById('edit_phone').value = member.phone;
                    document.getElementById('edit_role').value = member.role;
                    document.getElementById('edit_is_visible').checked = member.is_visible;
                    
                    // Afficher la photo actuelle
                    const photoContainer = document.getElementById('currentPhotoContainer');
                    if (member.photo) {
                        photoContainer.innerHTML = `
                            <p class="small mb-1">Photo actuelle:</p>
                            <img src="{{ asset('storage') }}/${member.photo}" 
                                 class="img-thumbnail" 
                                 style="max-width: 100px; max-height: 100px;">
                        `;
                    } else {
                        photoContainer.innerHTML = '<p class="small text-muted">Aucune photo</p>';
                    }
                });
        });

        
    }

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