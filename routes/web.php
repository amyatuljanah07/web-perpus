<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\SiswaAuthController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\BorrowRequestController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SiswaBooksController;

// Welcome/Landing page route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('admin')->name('admin.')->group(function () {
    // Public admin routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    
    // Book routes
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show'); // Changed from 'books' to 'books.show'
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    
    // Member routes
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
    Route::post('/members', [MemberController::class, 'store'])->name('members.store');
    Route::get('/members/{id}', [MemberController::class, 'show'])->name('members.show');
    Route::get('/members/{id}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::post('/members/{id}/approve', [MemberController::class, 'approve'])->name('members.approve');
    Route::post('/members/{id}/reject', [MemberController::class, 'reject'])->name('members.reject');
    Route::put('/members/{id}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
    
    // Transaction routes
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions/{id}/return', [TransactionController::class, 'return'])->name('transactions.return');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    
    // Borrow request routes
    Route::get('/borrow-requests', [BorrowRequestController::class, 'index'])->name('borrow-requests.index');
    Route::post('/borrow-requests/{id}/approve', [BorrowRequestController::class, 'approve'])->name('borrow-requests.approve');
    Route::post('/borrow-requests/{id}/reject', [BorrowRequestController::class, 'reject'])->name('borrow-requests.reject');
});


Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/register', [SiswaAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [SiswaAuthController::class, 'register']);
    Route::get('/login', [SiswaAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [SiswaAuthController::class, 'login']);
    Route::get('/dashboard', [SiswaAuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [SiswaAuthController::class, 'logout'])->name('logout');
    Route::get('/books/{id}', [SiswaBooksController::class, 'show'])->name('books.show');
    Route::post('/pinjam-buku/{id}', [SiswaBooksController::class, 'borrow'])->name('books.borrow');
    Route::post('/books/{id}/return', [SiswaBooksController::class, 'return'])->name('books.return');
    Route::get('/riwayat', [SiswaAuthController::class, 'riwayat'])->name('riwayat');
    Route::post('/siswa/books/{borrowing}/request-return', [SiswaAuthController::class, 'requestReturn'])->name('siswa.books.request-return');
});
Route::delete('/admin/members/{id}', [\App\Http\Controllers\Admin\MemberController::class, 'destroy'])->name('admin.members.destroy');
