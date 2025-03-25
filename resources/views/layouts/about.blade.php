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
        .board-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 3rem 0;
        }
        .member-card {
    transition: transform 0.3s, box-shadow 0.3s;
    border-radius: 15px !important;
    overflow: hidden;
}

.member-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(161,44,47,0.1) !important;
}

.member-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.social-links i {
    transition: color 0.3s;
    font-size: 1.2rem;
}

.social-links a:hover i {
    color: #D4AF37 !important;
}

.card-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
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

        <div class="row g-4">
            <!-- Membre 1 -->
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="member-card card h-100 border-0 shadow-lg">
                    <div class="card-img-top position-relative overflow-hidden" style="height: 300px;">
                        <img src="{{asset('assets\images\team-1.jpg')}}" class="w-100 h-100 object-fit-cover" alt="Président ANEEPES">
                        <div class="member-overlay" style="background: linear-gradient(transparent 60%, rgba(161,44,47,0.9));"></div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #A12C2F;">John Doe</h5>
                        <p class="text-uppercase small mb-3" style="color: #D4AF37; letter-spacing: 1px;">Président National</p>
                        <div class="social-links d-flex justify-content-center gap-3">
                            <a href="#" class="text-decoration-none" style="color: #A12C2F;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-decoration-none" style="color: #A12C2F;">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a href="#" class="text-decoration-none" style="color: #A12C2F;">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Membre 2 -->
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="member-card card h-100 border-0 shadow-lg">
                    <div class="card-img-top position-relative overflow-hidden" style="height: 300px;">
                        <img src="{{asset('assets\images\team-1.jpg')}}" class="w-100 h-100 object-fit-cover" alt="Vice-Présidente">
                        <div class="member-overlay" style="background: linear-gradient(transparent 60%, rgba(161,44,47,0.9));"></div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title" style="color: #A12C2F;">Jane Smith</h5>
                        <p class="text-uppercase small mb-3" style="color: #D4AF37; letter-spacing: 1px;">Vice-Présidente</p>
                        <div class="social-links d-flex justify-content-center gap-3">
                            <a href="#" class="text-decoration-none" style="color: #A12C2F;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-decoration-none" style="color: #A12C2F;">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a href="#" class="text-decoration-none" style="color: #A12C2F;">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ajouter les autres membres de la même manière -->
        </div>
    </div>
</section>
  
</body>
   

@endsection