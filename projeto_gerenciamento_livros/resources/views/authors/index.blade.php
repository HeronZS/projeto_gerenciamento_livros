{{-- resources/views/authors/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Autores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-user-edit text-primary"></i> Autores</h1>
    <a href="{{ route('authors.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Autor
    </a>
</div>

<div class="row">
    @forelse($authors as $author)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $author->name }}</h5>
                    @if($author->email)
                        <p class="card-text">
                            <i class="fas fa-envelope text-muted"></i> {{ $author->email }}
                        </p>
                    @endif
                    <p class="card-text">{{ Str::limit($author->bio, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-info">{{ $author->books_count }} livro(s)</span>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('authors.show', $author) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye"></i> Ver
                        </a>
                        <a href="{{ route('authors.edit', $author) }}" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('authors.destroy', $author) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" 
                                    onclick="return confirm('Confirma a exclusão?')">
                                <i class="fas fa-trash"></i> Excluir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-user-edit fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Nenhum autor encontrado</h4>
                <a href="{{ route('authors.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus"></i> Cadastrar Primeiro Autor
                </a>
            </div>
        </div>
    @endforelse
</div>

{{ $authors->links() }}
@endsection