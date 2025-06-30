@extends('master')
@section('title') Blog @endsection
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
    .article-header-image {
        height: 500px;
        object-fit: cover;
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .star-rating {
        font-size: 2rem;
        cursor: pointer;
    }

    .star {
        color: #e4e5e9;
        transition: color 0.2s;
        margin-right: 0.3rem;
    }

    .star:hover,
    .star.active {
        color: #D4AF37;
    }

    .average-rating .stars {
        font-size: 1.2rem;
    }

    .comment-card {
        padding: 1.5rem;
        background: rgba(161, 44, 47, 0.05);
        border-radius: 0.5rem;
    }

    .shadow-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .shadow-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(161, 44, 47, 0.1) !important;
    }

    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 2rem 0;
    }

    .comment-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-left: 3px solid #A12C2F;
    }

    .comment-card:hover {
        transform: translateX(5px);
        box-shadow: 0 0.5rem 1rem rgba(161, 44, 47, 0.1) !important;
    }

    .avatar-img {
        object-fit: cover;
        border: 2px solid #D4AF37;
        padding: 2px;
    }

    .comment-text {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #4a4a4a;
    }

    .comment-actions {
        font-size: 0.85rem;
    }

    .comment-actions button:hover {
        color: #A12C2F !important;
    }

    .stars.small {
        font-size: 0.8rem;
    }
</style>

@endsection

@section('content')

<div class="container py-5">
    <!-- Fil d'Ariane -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('blog') }}">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($post->title, 30) }}</li>
        </ol>
    </nav>

    <!-- Article principal -->
    <article class="card border-0 shadow-lg mb-5" data-aos="fade-up">
        <!-- Image -->
        <img src="{{ Storage::url($post->image) }}" 
             class="card-img-top article-header-image" 
             alt="{{ $post->title }}">

        <div class="card-body px-4 px-md-5 py-4">
            <!-- En-tête -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center">
                    <img src="{{ Storage::url($post->editor->avatar) }}" 
                         class="rounded-circle me-3" 
                         alt="{{ $post->editor->avatar }}" 
                         style="width: 40px; height: 40px;">
                    <div>
                        <h5 class="mb-0 text-danger">{{ $post->editor->name }}</h5>
                        <small class="text-muted">
                            Publié {{ $post->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
                <span class="badge bg-danger fs-6">{{ $post->category }}</span>
            </div>

            <!-- Titre -->
            <h1 class="display-5 fw-bold mb-4 text-danger">{{ $post->title }}</h1>

            <!-- Contenu -->
            <div class="article-content mb-5">
                {!! Str::markdown($post->content) !!}
            </div>

            <!-- Notation -->
            <div class="rating-section border-top pt-4 mb-5">
                @if($errors->has('rating'))
                <div class="alert alert-danger mb-3">
                    {{ $errors->first('rating') }}
                </div>
            @endif
        
            @if(session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success') }}
                </div>
            @endif
                <form method="POST" action="{{ route('posts.ratings.store', $post) }}" id="ratingForm">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h5 class="text-danger mb-3">Notez cet article</h5>
                            <div class="star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star-fill star" data-rating="{{ $i }}"></i>
                                @endfor
                                <input type="hidden" name="rating" id="selectedRating" value="0">
                            </div>
                            @error('rating')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="average-rating">
                                <span class="display-4 text-danger">{{ number_format($post->average_rating, 1) }}</span>
                                <div class="stars small">
                                    @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star-fill   {{ $i <= round($post->average_rating) ? 'text-danger' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                                <small class="text-muted">{{ $post->ratings_count }} votes</small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Commentaires -->
            <div class="comments-section">
                <h4 class="text-danger mb-4"><i class="bi bi-chat-dots me-2"></i>Commentaires</h4>
                
                <!-- Formulaire de commentaire -->
                @auth
                <div class="comment-form mb-5">
                    <form method="POST" action="{{ route('posts.comments.store', $post) }}">
                        @csrf
                        <div class="mb-3">
                            <textarea name="content" 
                                      class="form-control border-danger" 
                                      rows="3"
                                      placeholder="Votre commentaire..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-send me-2"></i>Commenter
                        </button>
                    </form>
                </div>
                @endauth
                

                <!-- Liste des commentaires -->
                <div class="comments-container mt-5">
                    <h4 class="text-danger mb-4"><i class="bi bi-chat-right-text me-2"></i>Commentaires</h4>
                
                    @foreach($post->comments as $comment)
                    <div class="comment-card bg-white rounded-3 p-3 mb-3 shadow-sm transition-all">
                        <div class="d-flex align-items-start gap-3">
                            <!-- Avatar -->
                            <div class="avatar-container">
                                <img src="{{ $comment->user->avatar ? Storage::url($comment->user->avatar) : asset('default-avatar.png') }}" 
                                     class="rounded-circle avatar-img" 
                                     alt="{{ $comment->user->name }}"
                                     style="width: 40px; height: 40px;">
                            </div>
                
                            <!-- Contenu du commentaire -->
                            <div class="comment-body flex-grow-1">
                                <!-- En-tête -->
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h6 class="mb-0 fw-bold text-danger">{{ $comment->user->name }}</h6>
                                        <small class="text-muted">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $comment->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <div class="stars small ms-2">
                                        @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star-fill {{ $i <= $comment->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                
                                <!-- Texte du commentaire -->
                                <p class="mb-2 comment-text">{{ $comment->content }}</p>
                
                                <!-- Actions -->
                                <div class="comment-actions d-flex gap-3 mt-2">
                                    <button class="btn btn-link text-muted p-0 text-decoration-none">
                                        <i class="bi bi-hand-thumbs-up me-1"></i>J'aime
                                    </button>
                                    <button class="btn btn-link text-muted p-0 text-decoration-none">
                                        <i class="bi bi-reply me-1"></i>Répondre
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </article>

    <!-- Articles similaires -->
    <section class="related-posts mb-5" data-aos="fade-up">
        <h3 class="text-danger mb-4">Vous pourriez aimer</h3>
        <div class="row g-4">
            @foreach($relatedPosts as $related)
            <div class="col-md-4">
                <div class="card border-0 shadow-hover h-100">
                    <img src="{{ Storage::url($related->image) }}" 
                         class="card-img-top" 
                         alt="{{ $related->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($related->title, 50) }}</h5>
                        <a href="{{ route('blog.show', $related) }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>


@endsection

@section('extra-script')




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('selectedRating');
        const ratingForm = document.getElementById('ratingForm');
    
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.dataset.rating);
                ratingInput.value = rating;
                
                // Mise à jour visuelle
                stars.forEach((s, index) => {
                    s.classList.toggle('active', index < rating);
                    s.style.color = index < rating ? '#D4AF37' : '#e4e5e9';
                });
    
                // Soumission automatique du formulaire
                ratingForm.submit();
            });
    
            star.addEventListener('mouseover', function() {
                const hoverRating = parseInt(this.dataset.rating);
                stars.forEach((s, index) => {
                    s.style.color = index < hoverRating ? '#D4AF37' : '#e4e5e9';
                });
            });
    
            star.addEventListener('mouseout', function() {
                const currentRating = parseInt(ratingInput.value);
                stars.forEach((s, index) => {
                    s.style.color = index < currentRating ? '#D4AF37' : '#e4e5e9';
                });
            });
        });

    
        // Gestion de la réponse du serveur
        ratingForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            try {
                const response = await fetch(ratingForm.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        rating: ratingInput.value
                    })
                });
    
                const data = await response.json();
                
                if (response.ok) {
                    // Recharger la page pour voir la nouvelle moyenne
                    window.location.reload();
                } else {
                    alert(data.message || 'Erreur lors de la notation');
                }
            } catch (error) {
                console.error('Erreur:', error);
            }
        });


         // Initialisation des animations
         AOS.init({
            duration: 800,
            once: true
        });
    });

    </script>
@endsection