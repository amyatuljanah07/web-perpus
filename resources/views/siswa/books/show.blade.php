@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                @if($book->cover_url)
                    <img src="{{ $book->cover_url }}" class="card-img-top" alt="{{ $book->title }}">
                @else
                    <div class="bg-light p-4 text-center">No Cover</div>
                @endif
            </div>
        </div>
        <div class="col-md-8">
            <h2>{{ $book->title }}</h2>
            <p class="text-muted">Oleh: {{ $book->author }}</p>
            
            <div class="mb-4">
                <h5>Deskripsi:</h5>
                <p>{{ $book->synopsis }}</p>
            </div>

            <div class="mb-4">
                <p><strong>Stok tersedia:</strong> {{ $book->stock }}</p>
            </div>

            @if($book->stock > 0)
                <form action="{{ route('siswa.borrow', $book->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Pinjam Buku</button>
                </form>
            @else
                <button class="btn btn-secondary" disabled>Stok Habis</button>
            @endif

            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
