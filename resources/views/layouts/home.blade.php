@extends('master')
@section('title')
Accueil
@endsection

@section('extra-style')
<style>
        :root {
    --primary: #a12c2f;
    --gold: #FFD700;
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


/* Hero Section */
.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    z-index: 0;
}

.hero-overlay {
    position: relative;
    z-index: 1;
    background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.5));
    padding: 120px 0;
}

.hero-divider {
    width: 100px;
    height: 3px;
    background: var(--gold);
    margin: 0 auto;
}
.date-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        color: white;
        padding: 8px 12px;
        border-radius: 8px;
        text-align: center;
        line-height: 1.2;
    }
/* Cards */
.service-card {
    transition: transform 0.3s;
    border: 2px solid var(--primary);
}

.service-card:hover {
    transform: translateY(-10px);
    border-color: var(--gold);
}

.news-card {
    border-left: 4px solid var(--primary);
}

/* Couleurs personnalisées */
.text-gold { color: var(--gold) !important; }
.bg-gold { background-color: var(--gold) !important; }
.border-gold { border-color: var(--gold) !important; }
.btn-outline-gold {
    border-color: var(--gold);
    color: var(--gold);
}
.btn-outline-gold:hover {
    background-color: var(--gold);
    color: #000;
}
.btn-gold {
    background-color: var(--gold);
    color: #000;
    font-weight: 600;
}


</style>
@endsection
@section('content')
<!-- Section Hero Moderne -->
<section class="section main-banner  mt-5" id="top" data-section="section1">
    <div class="hero-background" style="background-image: url('assets/images/aneepes-banner.jpg');"></div>
    
    <div class="hero-overlay header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <div class="hero-content">
                        <h1 class="display-3 mb-4 text-white">Bienvenue à l'ANEEPES</h1>
                        <div class="hero-divider mb-4"></div>
                        <p class="lead text-white mb-5">L'<strong class="text-gold">ANEEPES</strong> est un mouvement étudiant regroupant les étudiants et stagiaires des établissements privés d'enseignement supérieur du Bénin.</p>
                        <div class="d-flex gap-3 justify-content-center">
                            <a href="#members" class="btn btn-lg btn-primary px-5">Nous rejoindre</a>
                            <a href="#news" class="btn btn-lg btn-outline-gold px-5">Actualités</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Services -->
<section class="py-7 bg-light">
    <div class="container">
        <div class="row g-4">
            <!-- Carte Actualités -->
            <div class="col-md-6 col-lg-3">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-newspaper fa-3x text-primary mb-3"></i>
                        <h3 class="h5 mb-3">Actualités</h3>
                        <p class="text-muted">Restez informé des dernières nouvelles</p>
                        <a href="{{route('actualites')}}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <!-- Carte Événements -->
            <div class="col-md-6 col-lg-3">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-star fa-3x text-primary mb-3"></i>
                        <h3 class="h5 mb-3">Événements</h3>
                        <p class="text-muted">Participez à nos rencontres étudiantes</p>
                        <a href="{{route('event')}}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <!-- Carte Sondage -->
            <div class="col-md-6 col-lg-3">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-poll-people fa-3x text-primary mb-3"></i>
                        <h3 class="h5 mb-3">Sondages</h3>
                        <p class="text-muted">Exprimez votre opinion</p>
                        <a href="{{route('sondage')}}" class="stretched-link"></a>
                    </div>
                </div>
            </div>

            <!-- Carte Blog -->
            <div class="col-md-6 col-lg-3">
                <div class="card service-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-blog fa-3x text-primary mb-3"></i>
                        <h3 class="h5 mb-3">Blog Étudiant</h3>
                        <p class="text-muted">Découvrez nos articles</p>
                        <a href="{{route('blog')}}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Actualités & Sondage -->
<section class="py-7" id="news">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <h2 class="mb-4 border-bottom border-primary pb-2">Dernières Actualités</h2>
                
                <!-- Article 1 -->
                @foreach ( $latestNews as $item )
                <article class="card mb-4 news-card">
                    <div class="row g-0">
                        <div class="col-md-4 position-relative">
                            <img src="{{ asset('storage/' . $item->photo) }}"  
                            class="card-img-top" 
                            alt="{{ $item->title }}" 
                            style="height: 200px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="h5 card-title">  {{ Str::limit($item->title, 50) }} </h3>
                                <div class="text-muted mb-2"><i class="fas fa-calendar me-2"></i>{{ $item->created_at->format('d/m/y') }}</div>
                                <p class="card-text"> {{ Str::limit($item->description, 100) }}</p>
                                <a  href="{{ route('actualites.show', $item->id) }}" class="btn btn-sm "  style="background-color: #A12C2F;">Lire plus</a>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
                

                
            </div>

            <!-- Sidebar Sondage -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <div class="card border-gold">
                        <div class="card-header bg-gold text-dark">
                            <h3 class="h6 mb-0"><i class="fas fa-poll me-2"></i>Sondage du mois</h3>
                        </div>
                        <div class="card-body">
                            <h4 class="h6 mb-3">Thèmes prioritaires pour 2024</h4>
                            <form>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="poll">
                                    <label class="form-check-label">Formation professionnelle</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="poll">
                                    <label class="form-check-label">Insertion professionnelle</label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="poll">
                                    <label class="form-check-label">Vie associative</label>
                                </div>
                                <button class="btn btn-primary w-100">Voter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Membres -->
<section class="py-7 bg-dark text-white" id="members">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <h2 class="mb-4"><span class="text-gold">Espace</span> Membres</h2>
                <div class="accordion">
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button bg-dark text-white" type="button">
                                Avantages exclusifs
                            </button>
                        </h3>
                        <div class="accordion-body">
                            <ul class="list-unstyled">
                                <li class="mb-3"><i class="fas fa-star me-2 text-gold"></i>Accès aux événements privés</li>
                                <li class="mb-3"><i class="fas fa-star me-2 text-gold"></i>Réseau étudiant national</li>
                                <li class="mb-3"><i class="fas fa-star me-2 text-gold"></i>Support juridique</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card bg-transparent border-gold">
                    <div class="card-body">
                        <h3 class="h4 mb-4 text-gold">Adhésion en ligne</h3>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control bg-dark text-white border-gold" placeholder="Prénom">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control bg-dark text-white border-gold" placeholder="Nom">
                                </div>
                                <div class="col-12">
                                    <input type="email" class="form-control bg-dark text-white border-gold" placeholder="Email">
                                </div>
                                <div class="col-12">
                                    <select class="form-select bg-dark text-white border-gold">
                                        <option>Établissement d'origine</option>
                                        <!-- Options here -->
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-gold w-100">Valider l'inscription</button>
                                </div>
                            </div>
                        </form>
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
<!-- Section Membres -->
<section class="py-7 bg-dark text-white" id="members">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <h2 class="mb-4">Espace Membres</h2>
                <div class="accordion" id="memberAccordion">
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                Avantages membres
                            </button>
                        </h3>
                        <div id="collapseOne" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-check-circle me-2 text-primary"></i>Accès exclusif aux événements</li>
                                    <li class="mb-2"><i class="fas fa-check-circle me-2 text-primary"></i>Contenu premium</li>
                                    <li class="mb-2"><i class="fas fa-check-circle me-2 text-primary"></i>Réseautage communautaire</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 mt-5 mt-lg-0">
                <div class="card bg-transparent border-light">
                    <div class="card-body">
                        <h3 class="h5 mb-4">Devenir Membre</h3>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control bg-dark text-white" placeholder="Prénom">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control bg-dark text-white" placeholder="Nom">
                                </div>
                                <div class="col-12">
                                    <input type="email" class="form-control bg-dark text-white" placeholder="Email">
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-outline-light w-100">S'inscrire</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('extra-script')
<script>

</script>
@endsection
