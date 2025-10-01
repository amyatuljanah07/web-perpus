@extends('siswa.layout')

@section('title', 'Riwayat Peminjaman')
@section('page-title', 'Riwayat Peminjaman')

@section('content')
<div class="card">
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowHistory as $history)
                    <tr>
                        <td>{{ $history->book->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($history->borrow_date)->format('d/m/Y') }}</td>
                        <td>{{ $history->return_date ? \Carbon\Carbon::parse($history->return_date)->format('d/m/Y') : '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $history->status_display['class'] }}">
                                {{ $history->status_display['text'] }}
                            </span>
                            @if($history->status === 'Dipinjam')
                                <div class="small text-muted mt-1">
                                    Batas waktu: {{ \Carbon\Carbon::parse($history->due_date)->format('d/m/Y') }}
                                </div>
                            @endif
                        </td>
                        <td>Rp {{ number_format($history->fine, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
