@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ $book->cover_url ?? 'https://via.placeholder.com/350x500' }}" class="card-img-top" alt="Book Cover">
            </div>
        </div>
        <div class="col-md-8">
            <h2>{{ $book->title }}</h2>
            <p class="text-muted">Oleh: {{ $book->author }}</p>
            
            <div class="mb-3">
                <span class="badge bg-primary">{{ $book->category }}</span>
                <span class="badge bg-info">{{ $book->genre }}</span>
            </div>

            <div class="mb-4">
                <h5>Sinopsis:</h5>
                <p>{{ $book->synopsis }}</p>
            </div>

            <div class="d-flex gap-3 mb-4">
                <div>
                    <small class="text-muted">Tahun Terbit</small>
                    <p class="mb-0">{{ $book->year }}</p>
                </div>
                <div>
                    <small class="text-muted">Jumlah Halaman</small>
                    <p class="mb-0">{{ $book->pages }}</p>
                </div>
                <div>
                    <small class="text-muted">Stok</small>
                    <p class="mb-0">{{ $book->stock }}</p>
                </div>
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