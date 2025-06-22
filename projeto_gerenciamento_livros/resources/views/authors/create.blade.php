{{-- resources/views/authors/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Novo Autor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-user-plus text-primary"></i> Novo Autor</h1>
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<form action="{{ route('authors.store') }}" method="POST">
    @csrf
    
    <div class="row">
        <div class="col-md-8">
            <div class="mb-3">
                <label for="name" class="form-label">Nome *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Biografia</label>
                <textarea class="form-control @error('bio') is-invalid @enderror" 
                          id="bio" name="bio" rows="5">{{ old('bio') }}</textarea>
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
                            <i class="fas fa-asterisk text-danger"></i> Campos obrigatórios<br>
                            <i class="fas fa-user"></i> Nome será exibido nos livros
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Salvar
        </button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
@endsection