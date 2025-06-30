@extends('master')
@section('title')
Accueil
@endsection
<style>

.category-nav-scroller {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 1rem;
    }

    .category-pill {
        min-width: 150px;
        text-align: center;
       
        border-radius: 2rem;
        margin: 0 0.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: rgba(161, 44, 47, 0.1);
        color: #A12C2F;
        border: 2px solid transparent;
    }

    .category-pill:hover,
    .category-pill.active {
        background: #A12C2F !important;
        color: white !important;
        transform: translateY(-2px);
        border-color: #D4AF37;
    }

    .shadow-hover {
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .post-image-wrapper {
        border-radius: 0.5rem 0.5rem 0 0;
        height: 250px;
    }

    .post-image {
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .card:hover .post-image {
        transform: scale(1.05);
    }

    .category-tag {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.85rem;
    }

    .editor-avatar img {
        border: 2px solid #D4AF37;
        padding: 2px;
    }

    .btn-outline-danger {
        border-color: #A12C2F;
        color: #A12C2F;
    }

    .btn-outline-danger:hover {
        background: #A12C2F;
        color: white;
    }

    .pagination .page-link {
        color: #A12C2F;
    }

    .pagination .page-item.active .page-link {
        background: #A12C2F;
        border-color: #A12C2F;
    }





.option-card {
        cursor: pointer;
        border: 2px solid #dee2e6;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .option-card:hover:not(.active-option) {
        transform: translateY(-3px);
        border-color: #A12C2F;
        box-shadow: 0 4px 15px rgba(161, 44, 47, 0.1);
    }

    .active-option {
        border-color: #D4AF37 !important;
        background: rgba(212, 175, 55, 0.05);
        transform: translateY(-3px);
    }

    .form-check-input {
        width: 1.3em;
        height: 1.3em;
        margin-top: 0;
    }

    .form-check-input:checked {
        background-color: #D4AF37;
        border-color: #D4AF37;
    }

    .check-icon {
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.3s ease;
    }

    .active-option .check-icon {
        opacity: 1;
        transform: scale(1);
    }
    .text-gold-200 {
        color: rgba(212, 175, 55, 0.8);
    }
    
    @keyframes pulse-gold {
        0% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(212, 175, 55, 0); }
        100% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0); }
    }
    
    .voted-badge {
        animation: pulse-gold 2s infinite;
    }
    
    .btn-details:hover {
        color: #D4AF37;
    }
    
    .btn-reminder {
        border: none;
        background: none;
        color: #D4AF37;
        font-size: 1.2rem;
    }
    
    .event-gallery {
        position: relative;
        height: 200px;
    }
    
    .gallery-count {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(0,0,0,0.6);
        color: white;
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 0.9rem;
    }
    
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }
    
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }
    
    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }
    
    input:checked + .slider {
        background-color: #A12C2F;
    }
    
    input:checked + .slider:before {
        transform: translateX(26px);
    }
    
    .featured-event {
        color: white;
        padding: 2rem;
        border-radius: 15px;
        position: relative;
        min-height: 300px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }
    
    .event-countdown {
        position: absolute;
        top: 20px;
        right: 20px;
        text-align: center;
        background: rgba(255,255,255,0.2);
        padding: 1rem;
        border-radius: 10px;
    }
    
    .event-countdown span.days {
        font-size: 2rem;
        display: block;
        font-weight: bold;
    }
    .image-container {
        position: relative;
        max-width: 400px;
        margin: 2rem auto;
    }
    
    .image-wrapper {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        transform: translateZ(0);
        transition: transform 0.3s ease;
    }
    
    .image-wrapper::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, #a12c2f33 0%, #ffd70033 100%);
        mix-blend-mode: multiply;
        z-index: 1;
        transition: opacity 0.3s ease;
    }
    
    .image-wrapper::after {
        content: '';
        position: absolute;
        inset: -5px;
        background: linear-gradient(45deg, #a12c2f, #ffd700);
        z-index: -1;
        border-radius: 25px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .styled-logo {
        width: 100%;
        height: auto;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(161, 44, 47, 0.2);
        transform: scale(0.98);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Hover Effects */
    .image-wrapper:hover {
        transform: translateY(-5px);
    }
    
    .image-wrapper:hover::after {
        opacity: 1;
    }
    
    .image-wrapper:hover .styled-logo {
        transform: scale(1);
        box-shadow: 0 25px 50px rgba(161, 44, 47, 0.3);
    }
    
    .image-wrapper:hover::before {
        opacity: 0;
    }
    
    @media (max-width: 768px) {
        .image-container {
            max-width: 300px;
        }
    }
    .news-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border-radius: 15px !important;
        overflow: hidden;
    }
    
    .shadow-hover {
        box-shadow: 0 5px 15px rgba(161,44,47,0.08);
    }
    
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(161,44,47,0.12) !important;
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
    
    .date-badge span {
        display: block;
        font-size: 1.5rem;
        font-weight: 600;
    }
    
    .date-badge small {
        font-size: 0.8rem;
        text-transform: uppercase;
    }
    
    .category {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
    }
    
    .read-more {
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }
    
    .read-more:hover {
        color: #D4AF37 !important;
    }
    
    .page-link {
        border: 1px solid #A12C2F;
        margin: 0 5px;
        border-radius: 8px !important;
    }
    
    .page-link:hover {
        background: #f8f0e7;
    }
    .shadow-hover {
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .post-image-wrapper {
        border-radius: 0.5rem 0.5rem 0 0;
        height: 250px;
    }

    .post-image {
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .card:hover .post-image {
        transform: scale(1.05);
    }

    .category-tag {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.85rem;
    }

    .editor-avatar img {
        border: 2px solid #D4AF37;
        padding: 2px;
    }

    .btn-outline-danger {
        border-color: #A12C2F;
        color: #A12C2F;
    }

    .btn-outline-danger:hover {
        background: #A12C2F;
        color: white;
    }
    .bg-gradient-newsletter {
        background: linear-gradient(135deg, #A12C2F 0%, #94383b 100%);
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(161,44,47,0.2);
    }

    .border-gold {
        border-color: #D4AF37 !important;
    }

    .btn-gold {
        background: linear-gradient(to right, #D4AF37 0%, #A88734 100%);
        color: #A12C2F;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(212,175,55,0.4);
    }

    .shine-effect {
        background: linear-gradient(
            120deg,
            rgba(255,255,255,0) 30%,
            rgba(255,255,255,0.1) 50%,
            rgba(255,255,255,0) 70%
        );
        animation: shine 3s infinite;
        pointer-events: none;
    }

    .fly-animation {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes shine {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .font-playfair {
        font-family: 'Playfair Display', serif;
    }

    .z-index-1 {
        z-index: 1;
    }
    </style>
@section('extra-style')
<link rel="stylesheet" href="{{asset('assets/css/moncss.css')}}">


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
                        <p class="lead text-white mb-5">L'<strong class="text-gold">ANEEPES</strong> est l'association nationale des  étudiants et  établissements privés de l'enseignement supérieur du Bénin.</p>
                        <div class="d-flex gap-3 justify-content-center">
                            <a href="{{route('about')}}" class="btn btn-lg btn-outline-gold px-5">En savoir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Hero Section -->
<section class="hero-section bg-gradient-danger" data-aos="fade-up">
    <div class="container-fluid ps-5">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <h1 class="display-4 text-white mb-4">Bienvenue sur le Portail Étudiant</h1>
                <p class="lead text-light mb-4">Accédez à toutes les ressources de votre communauté étudiante</p>
                <a href="{{route('actualites')}}" class="btn btn-gold btn-lg">📢 Les news du moment ! </a>
                <a href="{{route('don')}}" class=" mt-3 btn  btn-gold btn-lg px-5 py-3">
                    <i class="fas fa-hand-holding-heart me-2"></i>
                    Soutenir l’ANEEPES
                  </a>
            </div>
            <div class="col-lg-7">
                          <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                                  @foreach($featuredNews as $news)
                                      <div class="hero-card mx-4" style="width: 85%; ">
                                          <div class="card border-0 shadow-lg">
                                            <img src="{{ asset('storage/' . $news->photo) }}" 
                                            class="card-img-top card-img" 
                                            alt="{{ $news->title }}" 
                                            style="height: 250px; object-fit: cover;">
                                              <div class="card-img-overlay bg-dark-overlay">
                                                  <h5 class="text-white">{{ $news->title }}</h5>
                                                  <p class="text-white">
                                                    {{ Str::limit($news->subtitle, 50) }}
                                                </p>
                                                  <a href="{{ route('actualites.show', $news) }}" class="btn btn-sm btn-danger" style="position:absolute; bottom: 10px;">Lire plus</a>
                                              </div>
                                          </div>
                                      </div>
                                  @endforeach
                          </div>
            </div>
        </div>
    </div>
  </section>
  
  <!-- Section Présentation -->
  <section class="about-section py-5 bg-light" data-aos="fade-up">
      <div class="container">
          <h2 class="section-title text-center mb-5">À propos de l'ANEEPES</h2>
          <div class="row">
              <div class="col-md-6">
                <div class="image-container">
                    <div class="image-wrapper">
                        <img 
                            src="{{ asset('assets/images/anepes-logo.jpg') }}" 
                            class="styled-logo" 
                            alt="Logo ANEEPES"
                        >
                    </div>
                </div>
            </div>
              <div class="col-md-6 d-flex flex-column justify-content-center">
                  <p class="lead">L'<strong>ANEEPES</strong> est une association nationale regroupant les étudiants et stagiaires inscrits dans les établissements privés d'enseignement supérieur du Bénin.</p>
                  <ul class="list-unstyled">
                      <li><i class="bi bi-check-circle-fill text-success me-2"></i> Promouvoir l'excellence académique</li>
                      <li><i class="bi bi-check-circle-fill text-success me-2"></i> Renforcer la solidarité entre étudiants</li>
                      <li><i class="bi bi-check-circle-fill text-success me-2"></i> Organiser des événements éducatifs et culturels</li>
                  </ul>
                  <a href="#events" class="btn btn-gold mt-3">En savoir plus</a>
              </div>
          </div>
      </div>
  </section>
  
  <!-- Section Actualités -->
  <section class="news-section py-5" data-aos="fade-up">
      <div class="container">
          <h2 class="section-title text-center mb-5">Dernières Actualités</h2>
          <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                @foreach($latestNews->chunk(2) as $index => $newsChunk)                              
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                      <div class="row">
                                        @foreach($latestNews as $item)
                                        <meta property="og:title" content="{{ $item->title }}">
                                        <meta property="og:description" content="{{ $item->subtitle }}">
                                        <meta property="og:image" content="{{ asset('storage/' . $item->photo) }}">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <article class="news-card card border-0 h-100 shadow-hover">
                                            <div class="img-container position-relative overflow-hidden">
                                                <img src="{{ asset('storage/' . $item->photo) }}" 
                                                     class="card-img-top" 
                                                     alt="{{ $item->title }}" 
                                                     style="height: 250px; object-fit: cover;">
                                                <div class="date-badge" style="background: #A12C2F;">
                                                    <span>{{ $item->created_at->format('d') }}</span>
                                                    <small>{{ $item->created_at->format('M') }}</small>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="meta mb-3">
                                                    <span class="category" style="background: {{ $item->type === 'event' ? '#D4AF37' : '#A12C2F' }}; color: white; padding: 0.25rem 0.75rem; border-radius: 20px;">
                                                        {{ ucfirst($item->type) }}
                                                    </span>
                                                    <span class="time text-muted">
                                                        <i class="fas fa-clock me-1"></i>
                                                        @php
                                                            // Calcul approximatif du temps de lecture
                                                            $wordCount = str_word_count(strip_tags($item->description));
                                                            $minutes = ceil($wordCount / 200);
                                                        @endphp
                                                        {{ $minutes }} min de lecture
                                                    </span>
                                                </div>
                                                <h3 class="card-title" style="color: #A12C2F;">
                                                    {{ Str::limit($item->title, 50) }}
                                                </h3>
                                                <p class="card-text">
                                                    {{ Str::limit($item->subtitle, 100) }}
                                                </p>
                                                <a href="{{ route('actualites.show', $item->id) }}" class="read-more" style="color: #A12C2F;">
                                                    Lire plus <i class="fas fa-arrow-right ms-2"></i>
                                                </a>
                                            </div>
                                        </article>
                                    </div>
                                    @endforeach
                                      </div>
                              </div>
                              @endforeach
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Précédent</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Suivant</span>
              </button>
          </div>
      </div>
  </section>
  
  <!-- Section Événements -->
  <section class="events-section py-5 bg-light" id="events" data-aos="fade-up">
      <div class="container">
          <h2 class="section-title text-center mb-5">Nos derniers evenements</h2>
                   <!-- Grille d'événements -->
                   <div class="event-grid">
                    <div class="row g-4">
                        @foreach($upcomingEvents as $event)
                        <div class="col-md-6 col-lg-4 ">
                            <div class="event-card">
                                <div class="event-badge {{ $event->statut === 'a_venir' ? 'upcoming' : 'past' }}">
                                    {{  $event->statut === 'a_venir' ? 'À venir' : 'Terminé' }}
                                  
                                </div>
                                <img src="{{ $event->image ? asset('storage/' . $event->image) : asset('images/default-event.jpg') }}" class="event-image" alt="Atelier">
                           
        
                                <div class="event-content">
                                    <div class="event-meta">
                                        <span class="category" style="background: #D4AF37;">{{ $event->type }}</span>
                                        <div class="date-location">
                                            <span><i class="fas fa-calendar"></i> {{ $event->date_heure->format('d/m/Y H:i') }}</span>
                                            <span><i class="fas fa-map-marker"></i> {{ $event->lieu }}</span>
                                        </div>
                                    </div>
                                    <h4>{{ $event->title }}</h4>
                                    
                                   
                                    <h4>{{ Str::limit($event->titre, 100) }}</h4>
                                    <p class="event-excerpt">{{ Str::limit($event->description, 100) }}</p>
                                        <div class="event-actions">
                                            <a href="{{ route('event.show', $event->id) }}" class="btn-details">Détails</a>
                                            <button class="btn-reminder" data-event-id="{{ $event->id }}">
                                                <i class="fas fa-bell"></i>
                                            </button>
                                        </div>
                                  
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
      </div>
  </section>
  
    <!-- Section Blog -->
    <section class="blog-section py-5" data-aos="fade-up">
      <div class="container">
          <h2 class="section-title text-center mb-5">Blog de l'ANEEPES</h2>
          <div class="container-fluid px-3 px-lg-5 py-5">
            <!-- En-tête héro -->
            <header class="text-center mb-5" data-aos="zoom-in">
                <h1 class="display-4 fw-bold text-danger mb-3 animate__animated animate__fadeInDown">Espace Blog Étudiant</h1>
                <p class="lead text-muted fs-5 animate__animated animate__fadeInUp">Partagez, découvrez, inspirez-vous !</p>
            </header>
        
            <!-- Navigation par catégories -->
            <div class="row mb-5" data-aos="fade-up">
                <div class="col-12">
                    <div class="category-nav-scroller">
                        <nav class="nav nav-pills justify-content-center flex-nowrap pb-3">
                            <a class="nav-link category-pill active" href="#" data-category="all">Toutes catégories</a>
                            @foreach(['sante', 'academique', 'emploi', 'culture', 'logement', 'evenements','technology', 'autre'] as $category)
                            <a class="nav-link category-pill" href="#" data-category="{{ $category }}">
                                <span class="text-dark"> {{ ucfirst($category) }} </span>
                            </a>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </div>
        
            <!-- Grille des articles -->
            <div class="row g-4" id="post-container">
                @foreach($blogPosts as $post)
                <div class="col-md-6 col-lg-4 post-card" data-category="{{ $post->category }}" data-aos="fade-up">
                    <article class="card h-100 border-0 shadow-hover transition-all">
                        <!-- Image du post -->
                        <div class="post-image-wrapper overflow-hidden position-relative">
                            <img src="{{ Storage::url($post->image) }}" 
                                 class="card-img-top post-image" 
                                 alt="{{ $post->title }}">
                            <span class="category-tag bg-danger">{{ $post->category }}</span>
                        </div>
        
                        <!-- Corps de la carte -->
                        <div class="card-body">
                            <!-- Métadonnées éditeur -->
                            <div class="d-flex align-items-center mb-3 editor-info">
                                <div class="editor-avatar me-2">
                                    <img src="{{ $post->editor->avatar ? Storage::url($post->editor->avatar) : asset('default-avatar.png') }}" 
                                         class="rounded-circle" 
                                         alt="{{ $post->editor->name }}"
                                         style="width: 40px; height: 40px;">
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold text-danger">{{ $post->editor->name }}</p>
                                    <small class="text-muted">
                                       {{ $post->created_at->diffForhumans() }}
                                    </small>
                                </div>
                            </div>
        
                            <!-- Contenu -->
                            <h3 class="h5 card-title text-dark mb-3">{{ Str::limit($post->title, 60) }}</h3>
                            <p class="card-text text-muted mb-4">    {!!  Str::limit($post->content,100) !!}</p>
                            
                            <!-- Bouton Lire la suite -->
                            <a href="{{ route('blog.show', $post) }}" 
                               class="btn btn-outline-danger d-flex align-items-center justify-content-between">
                                <span>Lire l'article</span>
                                <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
      </div>
  </section>
  
  <!-- Section Sondages -->
 

<div class="min-h-screen bg-[#A12C2F] py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- En-tête -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-white mb-4">Sondages Étudiants</h1>
            <p class="text-gold-200">Donnez votre avis en temps réel !</p>
        </div>

        <!-- Liste des sondages -->
        @forelse($activePolls as $poll)
        <div class="bg-white rounded-xl shadow-2xl mb-8 overflow-hidden transition-transform duration-300 hover:scale-[1.02]">
            <div class="p-6 border-b-2 border-[#D4AF37]">
                <h2 class="text-2xl font-bold text-[#A12C2F]">{{ $poll->question }}</h2>
                <div class="flex items-center mt-2 text-sm text-gray-500">
                    <span class="mr-4">🕑 {{ $poll->end_at ? $poll->end_at->diffForHumans() : 'Sans limite' }}</span>
                    <span>🗳 {{ $poll->votes_count }} votes</span>
                </div>
            </div>

            @if(!$poll->hasVoted(request()->cookie('voted_polls')))
            <form method="POST" action="{{ route('polls.vote', $poll) }}" class="p-6">
                @csrf
                <div class="space-y-4 mb-6" x-data="{ selected: null }">
                    <div class="row g-3">
                        @foreach($poll->options as $option)
                        <div class="col-12 col-md-6">
                            <div class="card option-card shadow-sm hover-shadow transition-all"
                                 :class="{ 'active-option': selected === {{ $option->id }} }"
                                 @click="selected = {{ $option->id }}">
                                <div class="card-body d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input 
                                            type="radio" 
                                            name="option_id" 
                                            value="{{ $option->id }}" 
                                            class="form-check-input"
                                            :checked="selected === {{ $option->id }}"
                                            required>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-0">{{ $option->text }}</h5>
                                    </div>
                                    <div class="check-icon ms-2">
                                        <i class="bi bi-check2-circle fs-4 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button 
                    type="submit" 
                    class="w-full py-3 bg-gradient-to-r from-[#D4AF37] to-[#A12C2F] text-white font-semibold rounded-lg hover:opacity-90 transition-opacity"
                >
                    Voter maintenant ✨
                </button>
            </form>
            @else
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($poll->options as $option)
                    <div class="relative pt-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-[#A12C2F]">{{ $option->text }}</span>
                            <span class="text-[#D4AF37] font-bold">{{ $option->percentage }}%</span>
                        </div>
                        <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                            <div 
                                class="h-full bg-gradient-to-r from-[#D4AF37] to-[#A12C2F] transition-all duration-1000"
                                style="width: {{ $option->percentage }}%"
                            ></div>
                        </div>
                        <div class="text-right text-sm text-gray-500 mt-1">
                            {{ $option->votes_count }} votes
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6 text-center text-[#A12C2F]">
                    ✅ Merci d'avoir participé à ce sondage !
                </div>
            </div>
            @endif
        </div>
        @empty
        <div class="text-center py-12">
            <div class="text-2xl text-white mb-4">🎉 Aucun sondage disponible pour le moment</div>
            <p class="text-[#D4AF37]">Revenez plus tard pour donner votre avis !</p>
        </div>
        @endforelse
    </div>
</div>
  
  <!--Section Contact-->
  <section class="contact-main py-6" data-aos="fade-up">
      <div class="container">
          <div class="row g-5">
              <!-- Formulaire -->
              <div class="col-lg-7">
                  <div class="card contact-form-card border-0 shadow-lg hover-lift">
                      <div class="card-body p-5">
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                          <h2 class="mb-4 text-danger">Envoyez-nous un message</h2>
                          
                          <form id="contactForm" method="POST" action="{{route('contact.submit')}}">
                              @csrf
                              
                              <div class="row g-4">
                                  <!-- Nom -->
                                  <div class="col-md-6">
                                      <div class="form-floating">
                                          <input type="text" 
                                                 class="form-control border-danger @error('name') is-invalid @enderror" 
                                                 id="name" 
                                                 name="name"
                                                 placeholder="Votre nom"
                                                 required>
                                          <label for="name" class="text-muted">
                                              <i class="fas fa-user me-2 text-danger"></i>Votre nom complet
                                          </label>
                                          @error('name')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>
                                  </div>
  
                                  <!-- Email -->
                                  <div class="col-md-6">
                                      <div class="form-floating">
                                          <input type="email" 
                                                 class="form-control border-danger @error('email') is-invalid @enderror" 
                                                 id="email" 
                                                 name="email"
                                                 placeholder="name@example.com"
                                                 required>
                                          <label for="email" class="text-muted">
                                              <i class="fas fa-envelope me-2 text-danger"></i>Adresse email
                                          </label>
                                          @error('email')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>
                                  </div>
  
                                  <!-- Sujet -->
                                  <div class="col-12">
                                      <div class="form-floating">
                                          <input type="text" 
                                                 class="form-control border-danger @error('subject') is-invalid @enderror" 
                                                 id="subject" 
                                                 name="subject"
                                                 placeholder="Sujet"
                                                 required>
                                          <label for="subject" class="text-muted">
                                              <i class="fas fa-tag me-2 text-danger"></i>Sujet du message
                                          </label>
                                          @error('subject')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>
                                  </div>
  
                                  <!-- Message -->
                                  <div class="col-12">
                                      <div class="form-floating">
                                          <textarea class="form-control border-danger @error('message') is-invalid @enderror" 
                                                    id="message" 
                                                    name="message"
                                                    placeholder="Votre message"
                                                    style="height: 150px"
                                                    required></textarea>
                                          <label for="message" class="text-muted">
                                              <i class="fas fa-comment-dots me-2 text-danger"></i>Votre message
                                          </label>
                                          @error('message')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                      </div>
                                  </div>
  
                                  <!-- Bouton -->
                                  <div class="col-12 text-center">
                                      <button type="submit" class="btn btn-danger btn-lg px-5 py-3">
                                          <i class="fas fa-paper-plane me-2"></i>Envoyer le message
                                      </button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
  
              <!-- Informations de contact -->
              <div class="col-lg-5">
                  <div class="contact-info-card bg-danger text-white rounded-3 p-5 shadow-lg">
                      <h3 class="text-white mb-5"><i class="fas fa-map-marker-alt me-2"></i>Nos coordonnées</h3>
                      
                      <ul class="list-unstyled">
                          <!-- Téléphone -->
                          <li class="d-flex mb-4">
                              <div class="icon-box bg-white text-danger rounded-circle me-3">
                                  <i class="fas fa-phone fa-lg"></i>
                              </div>
                              <div>
                                  <h5>Téléphone</h5>
                                  <a href="tel:+1234567890" class="text-white">+1 (234) 567-890</a>
                              </div>
                          </li>
  
                          <!-- Email -->
                          <li class="d-flex mb-4">
                              <div class="icon-box bg-white text-danger rounded-circle me-3">
                                  <i class="fas fa-envelope fa-lg"></i>
                              </div>
                              <div>
                                  <h5>Email</h5>
                                  <a href="mailto:contact@anepes.com" class="text-white">contact@anepes.com</a>
                              </div>
                          </li>
  
                          <!-- Adresse -->
                          <li class="d-flex mb-4">
                              <div class="icon-box bg-white text-danger rounded-circle me-3">
                                  <i class="fas fa-map-marked-alt fa-lg"></i>
                              </div>
                              <div>
                                  <h5>Adresse</h5>
                                  <address class="mb-0">123 Rue de l'Innovation<br>75000 Paris, France</address>
                              </div>
                          </li>
  
                          <!-- Horaires -->
                          <li class="d-flex">
                              <div class="icon-box bg-white text-danger rounded-circle me-3">
                                  <i class="fas fa-clock fa-lg"></i>
                              </div>
                              <div>
                                  <h5>Horaires</h5>
                                  <p class="mb-0">Lun-Ven : 8h-19h<br>Samedi : 9h-17h</p>
                              </div>
                          </li>
                      </ul>
  
                      <!-- Réseaux sociaux -->
                      <div class="social-links mt-5 pt-3">
                          <h5 class="mb-3">Suivez-nous</h5>
                          <div class="d-flex gap-3">
                              <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                              <a href="#" class="text-white"><i class="fab fa-twitter fa-2x"></i></a>
                              <a href="#" class="text-white"><i class="fab fa-linkedin fa-2x"></i></a>
                              <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>

  @endsection
  
  @section('extra-script')
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
      AOS.init();
  </script>
  
  <script>
      // Testimonials carousel
      $(".testimonial-carousel").owlCarousel({
          autoplay: true,
          smartSpeed: 1000,
          margin: 2,
          dots: false,
          loop: true,
          nav : true,
          navText : [
              
          ],
          responsive: {
              0:{
                  items:1
              },
              499:{
                  items:2
              },
                          999:{
                              items:3
                          }
          }
      });
  </script>
  
  <script>
  // Initialisation du compte à rebours
  function updateCountdown() {
      const countdownElements = document.querySelectorAll('.countdown-timer');
      
      countdownElements.forEach(element => {
          const targetDate = new Date(element.parentElement.dataset.date);
          const now = new Date();
          const difference = targetDate - now;
  
          const days = Math.floor(difference / (1000 * 60 * 60 * 24));
          const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  
          element.querySelector('.days').textContent = days.toString().padStart(2, '0');
          element.querySelector('.hours').textContent = hours.toString().padStart(2, '0');
      });
  }
  
  setInterval(updateCountdown, 1000);
  updateCountdown();
  </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filtrage des catégories
        const pills = document.querySelectorAll('.category-pill');
        const posts = document.querySelectorAll('.post-card');
    
        pills.forEach(pill => {
            pill.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Retirer l'état actif
                pills.forEach(p => p.classList.remove('active'));
                pill.classList.add('active');
                
                const category = pill.dataset.category;
                
                // Filtrer les articles
                posts.forEach(post => {
                    const postCategory = post.dataset.category;
                    if(category === 'all' || postCategory === category) {
                        post.style.display = 'block';
                    } else {
                        post.style.display = 'none';
                    }
                });
            });
        });
    
        // Initialisation des animations
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
            easing: 'ease-out-back'
        });
    });
    </script>
  @endsection