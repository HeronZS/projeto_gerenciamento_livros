{{-- resources/views/books/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Livros')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-book text-primary"></i> Livros</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Livro
    </a>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <form action="{{ route('books.search') }}" method="GET" class="d-flex">
            <input type="text" name="q" class="form-control" placeholder="Buscar por título ou autor..." 
                   value="{{ request('q') }}">
            <button type="submit" class="btn btn-outline-primary ms-2">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</div>

@if(isset($query))
    <div class="alert alert-info">
        <i class="fas fa-search"></i> Resultados para: <strong>{{ $query }}</strong>
    </div>
@endif

<div class="row">
    @forelse($books as $book)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $book->title }}</h5>
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="fas fa-user"></i> {{ $book->author->name }}
                        </small>
                    </p>
                    <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success">R$ {{ number_format($book->price, 2, ',', '.') }}</span>
                        <small class="text-muted">{{ $book->publication_year }}</small>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="btn-group w-100" role="group">
                        <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-outline-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" 
                                    onclick="return confirm('Confirma a exclusão?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Nenhum livro encontrado</h4>
                <a href="{{ route('books.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus"></i> Cadastrar Primeiro Livro
                </a>
            </div>
        </div>
    @endforelse
</div>

{{ $books->links() }}
@endsection