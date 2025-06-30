@extends('master')

@section('extra-style')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- AOS (Animate On Scroll) -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
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

</style>
@endsection

@section('content')

<section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
         
          <h2>Blog </h2>
        </div>
      </div>
    </div>
  </section>
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
                    <a class="nav-link category-pill text-primary" href="#" data-category="{{ $category }}">
                       <span class="text-dark"> {{ ucfirst($category) }} </span>
                    </a>
                    @endforeach
                </nav>
            </div>
        </div>
    </div>

    <!-- Grille des articles -->
    <div class="row g-4" id="post-container">
        @foreach($posts as $post)
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
                    <p class="card-text text-muted mb-4">{!! Str::limit($post->content, 120)!!}</p>
                    
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

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
        {{ $posts->links() }}
    </div>
</div>
@endsection

@section('extra-script')
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