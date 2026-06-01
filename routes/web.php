<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', function () {
    $activeBorrows = \App\Models\Borrow::with(['student', 'book'])
        ->whereNull('return_date')
        ->latest()
        ->get();

    $returnedBorrows = \App\Models\Borrow::with(['student', 'book'])
        ->whereNotNull('return_date')
        ->latest()
        ->limit(10)
        ->get();

    return view('dashboard', [
        'totalBooks' => \App\Models\Book::count(),
        'totalStudents' => \App\Models\Student::count(),
        'totalBorrows' => \App\Models\Borrow::count(),
        'activeBorrows' => $activeBorrows->count(),
        'activeBorrowsList' => $activeBorrows,
        'returnedBorrowsList' => $returnedBorrows,
    ]);
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::resource('books', BookController::class);
    Route::resource('students', StudentController::class);
    Route::resource('borrows', BorrowController::class);
});

require __DIR__.'/auth.php';
