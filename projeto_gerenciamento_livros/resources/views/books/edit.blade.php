{{-- resources/views/books/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Editar Livro')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-edit text-primary"></i> Editar Livro</h1>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<form action="{{ route('books.update', $book) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-md-8">
            <div class="mb-3">
                <label for="title" class="form-label">Título *</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title', $book->title) }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4">{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="mb-3">
                <label for="author_id" class="form-label">Autor *</label>
                <select class="form-select @error('author_id') is-invalid @enderror" id="author_id" name="author_id">
                    <option value="">Selecione um autor</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" 
                                {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
                @error('author_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="publication_year" class="form-label">Ano de Publicação *</label>
                <input type="number" class="form-control @error('publication_year') is-invalid @enderror" 
                       id="publication_year" name="publication_year" 
                       value="{{ old('publication_year', $book->publication_year) }}" 
                       min="1000" max="{{ date('Y') }}">
                @error('publication_year')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Preço (R$) *</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                       id="price" name="price" value="{{ old('price', $book->price) }}" 
                       step="0.01" min="0">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i> Informações
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="fas fa-calendar"></i> Criado em: {{ $book->created_at->format('d/m/Y') }}<br>
                            <i class="fas fa-user"></i> Autor atual: {{ $book->author->name }}
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Atualizar
        </button>
        <a href="{{ route('books.show', $book) }}" class="btn btn-info">
            <i class="fas fa-eye"></i> Visualizar
        </a>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
@endsection