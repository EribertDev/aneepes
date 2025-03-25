@extends('dashboard')
@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('extra-style')

<style>
    .news-content {
        font-size: 1.1rem;
        line-height: 1.6;
    }
    
    .news-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1rem 0;
    }
    
    .news-content table {
        width: 100%;
        margin: 1rem 0;
        border-collapse: collapse;
    }
    
    .news-content table td, .news-content table th {
        padding: 0.5rem;
        border: 1px solid #dee2e6;
    }
    </style>
@endsection
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-danger text-white">
            <h3 class="mb-0">{{ $actualite->title }}</h3>
        </div>
        <div class="card-body">
            <p class="text-muted"><strong>Publié le :</strong> {{ $actualite->created_at->format('d M Y') }}</p>

            @if($actualite->photo)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $actualite->photo) }}" alt="Image de l'actualité" class="img-fluid rounded shadow">
                </div>
            @endif

            <h5 class="text-secondary">{{ $actualite->subtitle }}</h5>

            <div class="mt-3">
                {!! $actualite->description !!}
            </div>

            <div class="mt-4">
                <a href="{{ route('news.filter') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour aux actualités
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
