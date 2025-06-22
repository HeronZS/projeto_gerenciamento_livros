{{-- resources/views/authors/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Editar Autor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-user-edit text-primary"></i> Editar Autor</h1>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<form action="{{ route('authors.update', $author) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-md-8">
            <div class="mb-3">
                <label for="name" class="form-label">Nome *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $author->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email', $author->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Biografia</label>
                <textarea class="form-control @error('bio') is-invalid @enderror" 
                          id="bio" name="bio" rows="5">{{ old('bio', $author->bio) }}</textarea>
                @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i> Informações
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="fas fa-calendar"></i> Criado em: {{ $author->created_at->format('d/m/Y') }}<br>
                            <i class="fas fa-book"></i> Total de livros: {{ $author->books->count() }}<br>
                            <i class="fas fa-asterisk text-danger"></i> Campos obrigatórios
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
        <a href="{{ route('authors.show', $author) }}" class="btn btn-info">
            <i class="fas fa-eye"></i> Visualizar
        </a>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
@endsection