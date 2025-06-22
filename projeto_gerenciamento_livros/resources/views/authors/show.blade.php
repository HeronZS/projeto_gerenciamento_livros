{{-- resources/views/authors/show.blade.php --}}
@extends('layouts.app')

@section('title', $author->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-user text-primary"></i> {{ $author->name }}</h1>
    <div>
        <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-info-circle"></i> Informações do Autor</h5>
            </div>
            <div class="card-body">
                @if($author->email)
                    <p><strong>Email:</strong> {{ $author->email }}</p>
                @endif
                
                @if($author->bio)
                    <p><strong>Biografia:</strong></p>
                    <p class="text-muted">{{ $author->bio }}</p>
                @endif
                
                <p><strong>Cadastrado em:</strong> {{ $author->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Última atualização:</strong> {{ $author->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-chart-bar"></i> Estatísticas</h5>
            </div>
            <div class="card-body text-center">
                <h2 class="text-primary">{{ $author->books->count() }}</h2>
                <p class="text-muted">Livro(s) publicado(s)</p>
            </div>
        </div>
    </div>
</div>

@if($author->books->count() > 0)
    <div class="mt-4">
        <h3><i class="fas fa-book"></i> Livros do Autor</h3>
        <div class="row">
            @foreach($author->books as $book)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title text-primary">{{ $book->title }}</h6>
                            <p class="card-text">{{ Str::limit($book->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">R$ {{ number_format($book->price, 2, ',', '.') }}</span>
                                <small class="text-muted">{{ $book->publication_year }}</small>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye"></i> Ver Detalhes
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="mt-4">
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Este autor ainda não possui livros cadastrados.
            <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm ms-2">
                <i class="fas fa-plus"></i> Adicionar Livro
            </a>
        </div>
    </div>
@endif
@endsection