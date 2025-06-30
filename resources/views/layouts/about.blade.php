@extends('master')
@section('title') A propos @endsection
@section('extra-style')

<style>
    :root {
    --primary-maroon: #A12C2F;
    --accent-gold: #D4AF37;
    --light-bg: #faf6f0;
    }

    body {
    font-family: 'Poppins', sans-serif;
    line-height: 1.6;
    color: #333;
    }

    .objectives-section {
    background: #fff5f5;
    padding: 4rem 2rem;
    }

    .objective-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .objective-card {
        background: white;
        border-left: 4px solid var(--accent-gold);
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 3px 15px rgba(161,44,47,0.05);
        display: flex;
        align-items: start;
        transition: transform 0.3s;
    }

    .objective-card:hover {
        transform: translateX(10px);
    }

    .objective-icon {
        font-size: 1.8rem;
        margin-right: 1rem;
        color: var(--primary-maroon);
        min-width: 50px;
        text-align: center;
    }

    .objective-content h3 {
        color: var(--primary-maroon);
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .objective-content p {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .objective-grid {
            grid-template-columns: 1fr;
        }
        
        .objective-card {
            flex-direction: column;
            align-items: start;
        }
        
        .objective-icon {
            margin-bottom: 1rem;
        }
    }

    /* Header */
    .hero-header {
        background: linear-gradient(45deg, var(--primary-maroon) 40%, #8a1f22);
        padding: 2rem 1rem;
        position: relative;
        overflow: hidden;
    }

    .logo-container {
        max-width: 200px;
        margin: 0 auto 2rem;
    }

    .logo-container img {
        width: 100%;
        height: auto;
    }

    /* Section Titre */
    .section-title {
        color: var(--primary-maroon);
        position: relative;
        padding-bottom: 1rem;
        margin: 2rem 0;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--accent-gold);
    }

    /* Cartes Devises */
    .motto-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        padding: 3rem 0;
    }

    .motto-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(161,44,47,0.1);
        text-align: center;
        transition: transform 0.3s;
        border: 2px solid var(--accent-gold);
    }

    .motto-card:hover {
        transform: translateY(-5px);
    }

    .motto-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: var(--accent-gold);
    }

    /* Section Constitution */
    .constitution-section {
        background: var(--light-bg);
        padding: 4rem 2rem;
    }

    .department-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 2rem;
    }

    .department-card {
        background: white;
        padding: 1rem;
        border-radius: 8px;
        text-align: center;
        border-left: 4px solid var(--primary-maroon);
    }

    /* Section Objectifs */
    .objectives-section {
        background: var(--light-bg);
        padding: 4rem 2rem;
    }

    .objective-grid {
        column-count: 2;
        column-gap: 3rem;
    }

    .objective-item {
        break-inside: avoid;
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        background: white;
        border-left: 4px solid var(--accent-orange);
    }


    /* Board Members */
    .board-section {
        padding: 5rem 0;
        background: linear-gradient(rgba(250, 246, 240, 0.9), rgba(250, 246, 240, 0.9)), 
                    url('{{ asset("assets/images/pattern.png") }}');
        background-size: cover;
        background-position: center;
    }
    
    .member-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        background: white;
    }
    
    .member-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 15px 40px rgba(161, 44, 47, 0.15);
    }
    
    .member-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.9;
        transition: opacity 0.3s ease;
    }
    
    .member-card:hover .member-overlay {
        opacity: 1;
    }
    
    .social-links a {
        transition: all 0.3s ease;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(161, 44, 47, 0.1);
    }
    
    .social-links a:hover {
        background: #A12C2F;
        color: white !important;
        transform: translateY(-3px);
    }
    
    .card-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        position: relative;
        display: inline-block;
    }
    
    .card-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 2px;
        background: #D4AF37;
        transition: width 0.3s ease;
    }
    
    .member-card:hover .card-title::after {
        width: 80px;
    }
    
    @media (max-width: 768px) {
        .board-section {
            padding: 3rem 0;
        }
        
        .member-card {
            max-width: 300px;
            margin: 0 auto;
        }
    }
       
</style>

@endsection


@section('content')
<body>

    <section class="heading-page header-text" id="top">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
             
              <h2>Qui Sommes nous ?</h2>
            </div>
          </div>
        </div>
      </section>
    <!-- Section Présentation -->
    <section class="container py-5">
        <h2 class="section-title">Présentation</h2>
        <div class="presentation-content">
            <p class="lead"> Elle est créée en République du Bénin un mouvement d’étudiant
                dénommé Association Nationale des Etudiants des Etablissement Privés de
                l’Enseignement Supérieur (ANEEPES-Bénin) regroupant les étudiants et
                stagiaires inscrits dans les établissements de l’enseignement supérieur privé du
                Bénin</p>
                <br>
                Elle est constituée des Coordinations Départementales (CD)
            
            <div class="department-grid">
                <div class="department-card">Atlantique</div>
                <div class="department-card">Borgou</div>
                <div class="department-card">Littoral</div>
                <div class="department-card">Ouémé</div>
                <div class="department-card">Zou-Collines</div>
                <div class="department-card">Plateau</div>
                <div class="department-card">Mono-Couffo</div>
                <div class="department-card">Atakora</div>
            </div>
        </div>
    </section>

    <!-- Section Objectifs -->
    <section class="objectives-section">
        <div class="container">
            <h2 class="section-title">Nos Objectifs Fondamentaux</h2>
            
            <div class="objective-grid">
                <!-- Colonne 1 -->
                <div class="objective-column">
                    <!-- Objectif 1 -->
                    <div class="objective-card">
                        <div class="objective-icon">🎓</div>
                        <div class="objective-content">
                            <h3>Conscience Estudiantine</h3>
                            <p>Affirmation du statut d'étudiant-chercheur et promoteur du savoir scientifique</p>
                        </div>
                    </div>
    
                    <!-- Objectif 2 -->
                    <div class="objective-card">
                        <div class="objective-icon">⚖️</div>
                        <div class="objective-content">
                            <h3>Éducation Inclusive</h3>
                            <p>Démocratisation d'un système éducatif de qualité accessible à tous sans discrimination</p>
                        </div>
                    </div>
    
                    <!-- Objectif 3 -->
                    <div class="objective-card">
                        <div class="objective-icon">🛡️</div>
                        <div class="objective-content">
                            <h3>Défense des Droits</h3>
                            <p>Résolution active des problèmes des étudiants et protection des franchises universitaires</p>
                        </div>
                    </div>
    
                    <!-- Objectif 4 -->
                    <div class="objective-card">
                        <div class="objective-icon">🤝</div>
                        <div class="objective-content">
                            <h3>Solidarité Active</h3>
                            <p>Promotion de l'entraide et du respect des biens publics/privés</p>
                        </div>
                    </div>
    
                    <!-- Objectif 5 -->
                    <div class="objective-card">
                        <div class="objective-icon">🌍</div>
                        <div class="objective-content">
                            <h3>Unité Nationale</h3>
                            <p>Création d'une communauté estudiantine unie au-delà des frontières</p>
                        </div>
                    </div>
                </div>
    
                <!-- Colonne 2 -->
                <div class="objective-column">
                    <!-- Objectif 6 -->
                    <div class="objective-card">
                        <div class="objective-icon">💼</div>
                        <div class="objective-content">
                            <h3>Participation Étudiante</h3>
                            <p>Implication dans toutes les décisions académiques et universitaires</p>
                        </div>
                    </div>
    
                    <!-- Objectif 7 -->
                    <div class="objective-card">
                        <div class="objective-icon">✌️</div>
                        <div class="objective-content">
                            <h3>Résolution de Conflits</h3>
                            <p>Privilégier les solutions amiables dans la communauté</p>
                        </div>
                    </div>
    
                    <!-- Objectif 8 -->
                    <div class="objective-card">
                        <div class="objective-icon">🇧🇯</div>
                        <div class="objective-content">
                            <h3>Citoyenneté Responsable</h3>
                            <p>Développement du sens civique et des valeurs démocratiques</p>
                        </div>
                    </div>
    
                    <!-- Objectif 9 -->
                    <div class="objective-card">
                        <div class="objective-icon">🤝</div>
                        <div class="objective-content">
                            <h3>Coopération Internationale</h3>
                            <p>Partenariats avec organisations éducatives et culturelles</p>
                        </div>
                    </div>
    
                    <!-- Objectif 10 -->
                    <div class="objective-card">
                        <div class="objective-icon">✊</div>
                        <div class="objective-content">
                            <h3>Engagement Social</h3>
                            <p>Soutien actif aux luttes pour la liberté et le progrès social</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Section Conseil d'Administration -->
<section class="board-section py-5" style="background: #faf6f0;">
    <div class="container">
        <h2 class="text-center mb-5" style="color: #A12C2F; position: relative;">
            Notre Conseil d'Administration
            <div style="position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%); width: 80px; height: 3px; background: #D4AF37;"></div>
        </h2>

        <div class="row g-4 justify-content-center">
            @foreach($boardMembers as $member)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="member-card card h-100 border-0 shadow-lg" style="overflow: hidden;">
                    <div class="position-relative overflow-hidden" style="height: 300px;">
                        @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}" class="w-100 h-100 object-fit-cover" alt="{{ $member->fullname }}">
                        @else
                            <div class="bg-secondary w-100 h-100 d-flex align-items-center justify-content-center">
                                <span class="text-white fw-bold" style="font-size: 3rem;">{{ substr($member->fullname, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="member-overlay" style="background: linear-gradient(transparent 60%, rgba(161,44,47,0.9));"></div>
                    </div>
                    <div class="card-body text-center py-4">
                        <h5 class="card-title mb-1" style="color: #A12C2F; font-weight: 600;">{{ $member->fullname }}</h5>
                        <p class="text-uppercase small mb-3" style="color: #D4AF37; letter-spacing: 1px;">
                            {{ $member->role }}
                        </p>
                        <div class="social-links d-flex justify-content-center gap-3">
                            @if($member->email)
                            <a href="mailto:{{ $member->email }}" class="text-decoration-none" style="color: #A12C2F;" title="Envoyer un email">
                                <i class="fas fa-envelope"></i>
                            </a>
                            @endif
                            @if($member->phone)
                            <a href="tel:{{ $member->phone }}" class="text-decoration-none" style="color: #A12C2F;" title="Téléphoner">
                                <i class="fas fa-phone"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
  
</body>
   

@endsection