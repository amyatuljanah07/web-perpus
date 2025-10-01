<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use App\Models\Book;
use App\Models\BorrowRequest;
use App\Models\Borrowing;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', strtolower($request->email))->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('is_admin', true);
            Session::put('admin_name', $admin->name);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Email atau password salah')->withInput($request->except('password'));
    }

    public function dashboard()
    {
        // Get total books (count distinct books)
        $totalBooks = Book::count();
        
        // Calculate new books added this month (count not sum)
        $newBooksThisMonth = Book::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        // Get borrowed books
        $borrowedBooks = Borrowing::where('status', 'Dipinjam')->count();
        
        // Get overdue books
        $overdueBooks = Borrowing::where('status', 'Dipinjam')
            ->whereNotNull('due_date')
            ->where('due_date', '<', now())
            ->count();
            
        // Get available books by counting books with stock > 0
        $availableBooks = Book::where('stock', '>', 0)->count();
        
        // Calculate percentage
        $availablePercentage = $totalBooks > 0 ? round(($availableBooks / $totalBooks) * 100) : 0;

        $name = Session::get('admin_name');
        
        // Get pending requests
        $pendingRequests = BorrowRequest::with(['siswa', 'book'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'borrowedBooks',
            'overdueBooks',
            'availableBooks',
            'availablePercentage',
            'pendingRequests',
            'newBooksThisMonth',
            'name'
        ));
    }

    public function books()
    {
        if (!Session::get('is_admin')) {
            return redirect()->route('admin.login')->with('error', 'Harap login terlebih dahulu');
        }

        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login');
    }
}
