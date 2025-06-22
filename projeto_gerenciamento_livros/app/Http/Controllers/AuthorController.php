<?php
// app/Http/Controllers/AuthorController.php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->paginate(10);
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:authors',
            'bio' => 'nullable|string'
        ]);

        Author::create($request->all());
        return redirect()->route('authors.index')->with('success', 'Autor criado com sucesso!');
    }

    public function show(Author $author)
    {
        $author->load('books');
        return view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:authors,email,' . $author->id,
            'bio' => 'nullable|string'
        ]);

        $author->update($request->all());
        return redirect()->route('authors.index')->with('success', 'Autor atualizado com sucesso!');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Autor removido com sucesso!');
    }
}