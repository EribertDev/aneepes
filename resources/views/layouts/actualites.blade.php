@extends('master')
@section('title')
    Actualités
@endsection
@section('extra-style')

<style>
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
    </style>
@endsection



@section('content')

<section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
         
          <h2>Nos Actualités</h2>
        </div>
      </div>
    </div>
  </section>
    <!-- Section Actualités -->
<section class="news-section py-5" style="background: #fff;">
    <div class="container">
        <h2 class="section-title text-center mb-5">Actualités de l'ANEEPES</h2>
        
        <div class="row g-4">
            @foreach($news as $item)
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
        
        @if($news->isEmpty())
        <div class="col-12 text-center py-5">
            <div class="alert alert-info">
                Aucune actualité disponible pour le moment
            </div>
        </div>
        @endif
        
        <!-- Pagination -->
        <div class="mt-4">
            {{ $news->links() }}
        </div>

            <!-- Ajouter d'autres articles -->
        </div>

        
    </div>
</section>

@endsection






