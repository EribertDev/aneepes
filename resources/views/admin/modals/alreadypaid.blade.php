<!-- Modal de notification de paiement existant -->
<div class="modal fade" id="paymentAlertModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="bi bi-check-circle-fill me-2"></i>Paiement existant
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-shrink-0">
                        <i class="bi bi-info-circle-fill text-success fs-1"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="text-success">Cotisation déjà payée</h5>
                        <p class="mb-0" id="paymentAlertMessage">
                            <!-- Le message sera injecté ici -->
                        </p>
                    </div>
                </div>
                
                <div class="alert alert-light border">
                    <div class="d-flex justify-content-between">
                        <span>Mois en cours:</span>
                        <strong id="currentMonthDisplay">{{ now()->format('F Y') }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Montant</span>
                        <span class="badge bg-success " id ="amount"></span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Statut:</span>
                        <span class="badge bg-success">Payé</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Fermer
                </button>
                <button type="button" class="btn btn-outline-success">
                    <i class="bi bi-receipt me-2"></i>Voir l'historique
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    #paymentAlertModal .modal-content {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

#paymentAlertModal .modal-header {
    border-bottom: 3px solid rgba(255,255,255,0.2);
}

#paymentAlertModal .modal-body {
    background: #f8f9fa url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none" stroke="%23e9ecef" stroke-width="2"/></svg>');
    background-size: 20px 20px;
}
</style>