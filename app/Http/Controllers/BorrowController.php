<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Student;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with(['student', 'book'])->latest()->paginate(10);

        return view('borrows.index', compact('borrows'));
    }

    public function create()
    {
        $students = Student::orderBy('name')->get();
        $books = Book::orderBy('title')->get();

        return view('borrows.create', compact('students', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,student_id'],
            'book_id' => ['required', 'exists:books,book_id'],
            'borrow_date' => ['required', 'date'],
            'return_date' => ['nullable', 'date', 'after_or_equal:borrow_date'],
        ]);

        Borrow::create($validated);

        return to_route('borrows.index')
            ->with('status', 'Borrow record created successfully.');
    }

    public function show(Borrow $borrow)
    {
        $borrow->load(['student', 'book']);

        return view('borrows.show', compact('borrow'));
    }

    public function edit(Borrow $borrow)
    {
        $students = Student::orderBy('name')->get();
        $books = Book::orderBy('title')->get();

        return view('borrows.edit', compact('borrow', 'students', 'books'));
    }

    public function update(Request $request, Borrow $borrow)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,student_id'],
            'book_id' => ['required', 'exists:books,book_id'],
            'borrow_date' => ['required', 'date'],
            'return_date' => ['nullable', 'date', 'after_or_equal:borrow_date'],
        ]);

        $borrow->update($validated);

        return to_route('borrows.index')
            ->with('status', 'Borrow record updated successfully.');
    }

    public function destroy(Borrow $borrow)
    {
        $borrow->delete();

        return to_route('borrows.index')
            ->with('status', 'Borrow record deleted successfully.');
    }
}
