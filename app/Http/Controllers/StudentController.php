<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(10);

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'class' => ['required', 'string', 'max:255'],
        ]);

        Student::create($validated);

        return to_route('students.index')
            ->with('status', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'class' => ['required', 'string', 'max:255'],
        ]);

        $student->update($validated);

        return to_route('students.index')
            ->with('status', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return to_route('students.index')
            ->with('status', 'Student deleted successfully.');
    }
}
