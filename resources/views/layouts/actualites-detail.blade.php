@extends('master')
@section('title')
    Actualités-detail
@endsection
@section('extra-style')
<style>

   
    
.news-hero {
    height: 60vh;
    background-size: cover;
    background-position: center;
    position: relative;
}

.news-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(rgba(161, 44, 47, 0.7), rgba(0, 0, 0, 0.5));
}

.news-header {
    position: relative;
    z-index: 1;
    padding-top: 15vh;
}

.gallery-item {
    transition: transform 0.3s;
    cursor: zoom-in;
}

.gallery-item:hover {
    transform: scale(1.03);
}

.btn.rounded-circle {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
}

</style>
@endsection


@section('content')
    <!-- Header Start -->
    <section class="heading-page header-text" id="top">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
             
              <h2>Actualités detail </h2>
            </div>
          </div>
        </div>
      </section>
    <!-- Header End -->


    
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="news-hero" style="background-image: url('{{ asset('storage/' . $news->photo) }}');">
                <div class="news-header text-center">
                    <div class="meta-badge d-inline-block mb-3" style="background: #A12C2F;">
                        {{ strtoupper($news->type) }}
                    </div>
                    <h1 class="display-6 fw-bold mb-3 text-white">{{ $news->title }}</h1>
                    <div class="text-light">
                        <span class="me-3"><i class="fas fa-calendar me-1"></i>{{ $news->created_at->isoFormat('LL') }}</span>
                        <span><i class="fas fa-user me-1"></i>{{ $news->author->name ?? 'ANEEPES Communication' }}</span>
                    </div>
                </div>
            </div>
            
            <div class="container mt-5 pt-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <article class="article-content">
                            <div class="lead mb-5 fs-5 text-muted">
                                {{ $news->subtitle }}
                            </div>
            
                            @if($news->gallery)
                            <div class="gallery-grid row g-3 mb-5">
                                @foreach(json_decode($news->gallery) as $image)
                                <div class="col-md-6">
                                    <img src="{{ asset('storage/' . $image) }}" 
                                         class="gallery-item img-fluid rounded-3" 
                                         alt="Galerie {{ $news->title }}">
                                </div>
                                @endforeach
                            </div>
                            @endif
            
                            <div class="content-body fs-5">
                                {!! $news->description !!}
                            </div>
            
                            <div class="social-share border-top pt-5 mt-5">
                                <h5 class="mb-4">Partager cet article</h5>
                                <div class="d-flex gap-3">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                                       class="btn btn-primary rounded-circle" 
                                       target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($news->title) }}&url={{ urlencode(url()->current()) }}" 
                                       class="btn btn-primary rounded-circle" 
                                       target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}" 
                                       class="btn btn-primary rounded-circle" 
                                       target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
            
                        @if($relatedNews->isNotEmpty())
                        <section class="related-articles mt-5 pt-5">
                            <h3 class="mb-4">À lire également</h3>
                            <div class="row g-4">
                                @foreach($relatedNews as $related)
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-hover h-100">
                                        <img src="{{ asset('storage/' . $related->photo) }}" 
                                             class="card-img-top" 
                                             alt="{{ $related->title }}"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ Str::limit($related->title, 50) }}</h5>
                                            <a href="{{ route('actualites.show', $related->id) }}" 
                                               class="btn btn-link text-primary p-0 stretched-link">
                                               Lire →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </section>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection