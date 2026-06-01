<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:0'],
        ]);

        Book::create($validated);

        return to_route('books.index')
            ->with('status', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:0'],
        ]);

        $book->update($validated);

        return to_route('books.index')
            ->with('status', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return to_route('books.index')
            ->with('status', 'Book deleted successfully.');
    }
}
