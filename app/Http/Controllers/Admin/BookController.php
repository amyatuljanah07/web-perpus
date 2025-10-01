<?php

// app/Http/Controllers/Admin/BookController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    private $categories = [
        'Romantis',
        'Horor',
        'Self Development',
        'Misteri',
        'Petualangan',
        'Fantasi',
        'Pendidikan',
        'Biografi',
        'Sejarah',
        
    ];

    public function index(Request $request)
    {
        $query = Book::latest();
        
        // Filter by genre if selected
        if ($request->genre) {
            $query->where('genre', $request->genre);
        }

        $books = $query->paginate(10)->withQueryString();

        return view('admin.books.index', [
            'books' => $books,
            'categories' => $this->categories
        ]);
    }

    public function create()
    {
        return view('admin.books.create', [
            'categories' => $this->categories
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'genre' => 'nullable',
            'pages' => 'nullable|numeric',
            'status' => 'required',
            'stock' => 'required|numeric',
            'year' => 'nullable|numeric',
            'synopsis' => 'required',
            'cover' => 'required|image|max:2048' // Validate image upload
        ]);

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('book-covers', 'public');
            $data['cover_url'] = $path;
        }

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.edit', [
            'book' => $book,
            'categories' => $this->categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'genre' => 'nullable',
            'pages' => 'nullable|numeric',
            'status' => 'required',
            'stock' => 'required|numeric',
            'year' => 'nullable|numeric',
            'synopsis' => 'required',
            'cover' => 'nullable|image|max:2048' // Validate image upload
        ]);

        if ($request->hasFile('cover')) {
            // Delete old cover if exists
            if ($book->cover_url) {
                Storage::disk('public')->delete($book->cover_url);
            }
            
            // Store new cover
            $path = $request->file('cover')->store('book-covers', 'public');
            $data['cover_url'] = $path;
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return back()->with('success', 'Buku berhasil dihapus');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.show', compact('book'));
    }
}
