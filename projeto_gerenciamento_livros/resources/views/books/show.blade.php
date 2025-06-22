{{-- resources/views/books/show.blade.php --}}
@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-book text-primary"></i> {{ $book->title }}</h1>
    <div>
        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-info-circle"></i> Detalhes do Livro</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Autor:</strong> 
                            <a href="{{ route('authors.show', $book->author) }}" class="text-primary">
                                {{ $book->author->name }}
                            </a>
                        </p>
                        <p><strong>Ano de Publicação:</strong> {{ $book->publication_year }}</p>
                        <p><strong>Preço:</strong> 
                            <span class="badge bg-success fs-6">R$ {{ number_format($book->price, 2, ',', '.') }}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Cadastrado em:</strong> {{ $book->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Última atualização:</strong> {{ $book->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
                
                @if($book->description)
                    <hr>
                    <h6><strong>Descrição:</strong></h6>
                    <p class="text-muted">{{ $book->description }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-user"></i> Sobre o Autor</h5>
            </div>
            <div class="card-body">
                <h6 class="text-primary">{{ $book->author->name }}</h6>
                @if($book->author->email)
                    <p><small><i class="fas fa-envelope"></i> {{ $book->author->email }}</small></p>
                @endif
                @if($book->author->bio)
                    <p class="text-muted">{{ Str::limit($book->author->bio, 100) }}</p>
                @endif
                <p><small><i class="fas fa-book"></i> {{ $book->author->books->count() }} livro(s) publicado(s)</small></p>
                
                <a href="{{ route('authors.show', $book->author) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-eye"></i> Ver Perfil
                </a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5><i class="fas fa-cog"></i> Ações</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar Livro
                    </a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" 
                                onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                            <i class="fas fa-trash"></i> Excluir Livro
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if($book->author->books->where('id', '!=', $book->id)->count() > 0)
    <div class="mt-4">
        <h4><i class="fas fa-books"></i> Outros livros de {{ $book->author->name }}</h4>
        <div class="row">
            @foreach($book->author->books->where('id', '!=', $book->id) as $otherBook)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">{{ $otherBook->title }}</h6>
                            <p class="card-text">{{ Str::limit($otherBook->description, 60) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">R$ {{ number_format($otherBook->price, 2, ',', '.') }}</span>
                                <small class="text-muted">{{ $otherBook->publication_year }}</small>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('books.show', $otherBook) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye"></i> Ver
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
@endsection