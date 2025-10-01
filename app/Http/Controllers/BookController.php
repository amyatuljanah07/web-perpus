<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function edit($id)
    {
        // Fetch book data
        // For now returning dummy data
        return response()->json([
            'id' => $id,
            'title' => 'Harry Potter',
            'author' => 'J.K. Rowling',
            'category' => 'Fiksi',
            'status' => 'Tersedia',
            'synopsis' => 'Lorem ipsum...',
            'cover_url' => 'https://via.placeholder.com/200x300'
        ]);
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'status' => 'required',
            'synopsis' => 'required',
        ]);

        // Update book logic here
        
        return redirect()->back()->with('success', 'Book updated successfully');
    }
}
