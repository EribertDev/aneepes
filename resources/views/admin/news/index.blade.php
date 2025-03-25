@extends('dashboard')
@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('extra-style')
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestion des actualités</h1>
        <a href="{{ route('news.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nouvelle actualité
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>
                                <span class="badge bg-{{ $item->type == 'event' ? 'warning' : 'info' }}">
                                    {{ $item->type }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $item->status == 'published' ? 'success' : 'secondary' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('news.show', $item->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{route('news.edit',$item)}}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection
