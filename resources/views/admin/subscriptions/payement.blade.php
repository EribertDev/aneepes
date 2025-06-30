@extends('dashboard')
@section('title', 'Subscriptions')
@section('page-title', 'Subscriptions')
@section('extra-style')
<script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
<!-- Dans votre layout -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .subscription-container {
        max-width: 500px;
        margin: 2rem auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .subscription-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 85, 164, 0.1);
        overflow: hidden;
    }
    
    .subscription-header {
        background: linear-gradient(135deg, #a12c2f, #a87375);
        color: white;
        padding: 2rem;
        text-align: center;
    }
    
    .subscription-header .logo {
        height: 60px;
        margin-bottom: 1rem;
    }
    
    .subscription-header h2 {
        margin: 0.5rem 0;
        font-size: 1.8rem;
    }
    
    .subscription-header p {
        opacity: 0.9;
        margin: 0;
    }
    
    .subscription-body {
        padding: 2rem;
    }
    
    .amount-selector {
        margin-bottom: 2rem;
    }
    
    .amount-selector h3 {
        color: #a12c2f;
        margin-bottom: 1rem;
    }
    
    .amount-options {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    
    .amount-option {
        flex: 1;
        min-width: 100px;
        padding: 1rem;
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-weight: bold;
        color: #a12c2f;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .amount-option:hover, .amount-option.active {
        background: #0055A4;
        color: white;
        border-color: #0055A4;
    }
    
    .custom-amount {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .custom-amount input {
        flex: 1;
        padding: 1rem;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 1rem;
        text-align: center;
    }
    
    .custom-amount span {
        font-weight: bold;
        color: #0055A4;
    }
    
    .pay-button {
        width: 100%;
        padding: 1.2rem;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .pay-button:hover {
        background: #218838;
    }
    
    .subscription-footer {
        padding: 1rem;
        text-align: center;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
    }
    
    .subscription-footer p {
        margin: 0;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    #loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        z-index: 9999;
        color: white;
    }
    
    .spinner {
        border: 5px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top: 5px solid white;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        margin-bottom: 1rem;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    </style>
@endsection
@section('content')

<div class="subscription-container">
    <div class="subscription-card">
        <div class="subscription-header">
            <img src="{{ asset('assets/images/anepes-logo.jpg') }}" alt="Aneepes Logo" class="logo">
            <h2>Paiement de cotisation</h2>
            <p>Soutenez l'association avec votre contribution mensuelle</p>
        </div>

        <div class="subscription-body">
            <div class="amount-selector">
                <h3>Montant de la cotisation</h3>
                <div class="amount-options">
                    <button class="amount-option" data-amount="1000">1 000 FCFA</button>
                    <button class="amount-option" data-amount="2000">2 000 FCFA</button>
                    <button class="amount-option" data-amount="5000">5 000 FCFA</button>
                </div>
                <div class="custom-amount">
                    <input type="number" id="custom-amount" min="100" value="">
                    <span>FCFA</span>
                </div>
            </div>

            <button id="pay-btn" class="pay-button">
                <i class="fas fa-lock"></i> Payer maintenant
            </button>
        </div>

        <div class="subscription-footer">
            <p><i class="fas fa-shield-alt"></i> Paiement 100% sécurisé par FedaPay</p>
        </div>
    </div>
</div>

<div id="loading-overlay">
    <div class="spinner"></div>
    <p>Redirection vers le paiement...</p>
</div>
@include('admin.modals.alreadypaid')
@endsection

@section('extra-scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const payBtn = document.getElementById('pay-btn');
       
         const amountInput = document.getElementById('custom-amount');
        let amount = parseInt(amountInput.value); // Montant par défaut
    
        // Gestion des options de montant
        document.querySelectorAll('.amount-option').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.amount-option').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                amount = parseInt(this.dataset.amount);
                document.getElementById('custom-amount').value = amount;
            });
        });
    
        // Gestion du montant personnalisé
        document.getElementById('custom-amount').addEventListener('change', function() {
            amount = parseInt(this.value) || 1000;
        });
    
        // Initialisation du paiement
            payBtn.addEventListener('click', function() {
        // Afficher le loading overlay
        const payBtn = this;
        const originalText = payBtn.innerHTML;
        payBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Traitement...';
        payBtn.disabled = true;
                
        
    $.ajax({
        url: '/cotisations/process',
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: JSON.stringify({ amount: amount }),
        success: function(data) {
            if (data.success === true) {
                // Initialisation de FedaPay
               // var payBtn = document.createElement('button');
                payBtn.click();
                FedaPay.init(payBtn, {
                    public_key: "pk_sandbox_Q-ZxJWnqXssq9tICFld2FsDv",
                    customer: {
                        firstname: data.name,
                        lastname: 'M/Mme',
                        email: data.email,
                    },
                    transaction: {
                        description: data.description,
                        amount: data.amount,
                        currency: { iso: 'XOF' }
                    },
                    onComplete: function(reason) {
                        if (reason?.reason === "CHECKOUT COMPLETE") {
                            // Vérification du paiement
                            $.ajax({
                                url: '/cotisations/verify',
                                type: 'POST',
                                dataType: 'json',
                                data: { 
                                    subscription_id: data.id,
                                    transaction_id: reason.transaction.id,
                                    status: reason.transaction.status,
                                    reference: reason.transaction.reference,
                                    amount: reason.transaction.amount,
                                    _token:$('meta[name="csrf-token"]').attr('content') // Récupération dynamique
                                },
                                success: function(response) {
                                    if (response.success === true) {
                                        window.location.href = "/cotisations/success";
                                    } else {
                                        showPaymentError("Échec de la vérification", response.message || "Le paiement n'a pas pu être vérifié");
                                    }
                                },
                                error: function(xhr) {
                                    const errorMsg = xhr.responseJSON?.message || "Erreur réseau";
                                    showPaymentError("Erreur technique", errorMsg);
                                }
                            });
                        } else {
                           const errorMsg = reason?.message || "Le paiement a été annulé ou a échoué.";
                            showPaymentError("Paiement annulé", errorMsg);
                        }
                    }
                });
            } else {
                if (data.status === 'paid') {
                    modal = new bootstrap.Modal(document.getElementById('paymentAlertModal'));
                    document.getElementById('paymentAlertMessage').innerText = data.message || "Vous    avez déjà payé pour ce mois.";  
                    document.getElementById('currentMonthDisplay').innerText = new Date().toLocaleString('default', { month: 'long', year: 'numeric' });
                    document.getElementById('amount').innerText = new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'XOF' }).format(data.amount);
                    
                    modal.show();
                } else if (data.status === 'pending') {
                    FedaPay.init(payBtn, {
                    public_key: "pk_sandbox_Q-ZxJWnqXssq9tICFld2FsDv",
                    customer: {
                        firstname: data.name,
                        lastname: 'M/Mme',
                        email: data.email,
                    },
                    transaction: {
                        description: data.description,
                        amount: data.amount,
                        currency: { iso: 'XOF' }
                    },
                    onComplete: function(reason) {
                        if (reason?.reason === "CHECKOUT COMPLETE") {
                            // Vérification du paiement
                            $.ajax({
                                url: '/cotisations/verify',
                                type: 'POST',
                                dataType: 'json',
                                data: { 
                                    subscription_id: data.id,
                                    transaction_id: reason.transaction.id,
                                    status: reason.transaction.status,
                                    reference: reason.transaction.reference,
                                    'amount': reason.transaction.amount,
                                    _token:$('meta[name="csrf-token"]').attr('content') // Récupération dynamique
                                },
                                success: function(response) {
                                    if (response.success === true) {
                                        window.location.href = "/cotisations/success";
                                    } else {
                                        showPaymentError("Échec de la vérification", response.message || "Le paiement n'a pas pu être vérifié");
                                    }
                                },
                                error: function(xhr) {
                                    const errorMsg = xhr.responseJSON?.message || "Erreur réseau";
                                    showPaymentError("Erreur technique", errorMsg);
                                }
                            });
                        } else {
                           const errorMsg = reason?.message || "Le paiement a été annulé ou a échoué.";
                            showPaymentError("Paiement annulé", errorMsg);
                        }
                    }
                });
                }
            }
        },
        error: function(xhr) {
            const errorMsg = xhr.responseJSON?.message || "Erreur lors de la requête";
            showPaymentError("Erreur", errorMsg);
        },
        complete: function() {
            // Réinitialiser le bouton dans tous les cas
            payBtn.innerHTML = originalText;
            payBtn.disabled = false;
        }
    });

        });

        // Fonction pour afficher les modals stylisés
        function showPaymentStatusModal(title, message, type) {

            const icon = type === 'success' 
                ? '<i class="bi bi-check-circle-fill text-success fs-1"></i>' 
                : '<i class="bi bi-x-circle-fill text-danger fs-1"></i>';

            const modalContent = `
                <div class="text-center p-4">
                    <div class="mb-3">${icon}</div>
                    <h4 class="mb-3">${title}</h4>
                    <p>${message}</p>
                    <div class="mt-4">
                        <button class="btn btn-${type === 'success' ? 'success' : 'danger'} w-50" data-bs-dismiss="modal">
                            Compris
                        </button>
                    </div>
                </div>
            `;

            // Utiliser SweetAlert2 ou un modal Bootstrap
            Swal.fire({
                title: title,
                html: modalContent,
                icon: type,
                showConfirmButton: true,
                customClass: {
                    popup: 'border-3 border-${type === "success" ? "success" : "danger"}'
                }
            });
        }

       

            function showPaymentError(title, message) {

            Swal.fire({
                title: title,
                html: `<div class="text-center">
                    <i class="bi bi-x-circle text-danger fs-1 mb-3"></i>
                    <p>${message}</p>
                </div>`,
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonClass: 'btn btn-danger'
            });
            }

            // Fonctions d'affichage des messages
            function showPaymentInfo(title, message) {
                Swal.fire({
                    title: title,
                    html: `<div class="text-center">
                        <i class="bi bi-info-circle text-primary fs-1 mb-3"></i>
                        <p>${message}</p>
                    </div>`,
                    icon: 'info',
                    confirmButtonText: 'Compris',
                    confirmButtonClass: 'btn btn-primary'
                });
            }

        // Fonction pour vérifier les paiements en attente
        function checkPendingPayment(subscriptionId) {
            fetch(`/cotisations/check-pending/${subscriptionId}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'paid') {
                    window.location.href = "/cotisations/success";
                } else {
                    showPaymentStatusModal(
                        "Paiement en attente",
                        "Votre paiement est toujours en cours de traitement. Nous vous notifierons lorsqu'il sera confirmé.",
                        "info"
                    );
                }
            });
        }
    });
    </script>






@endsection
