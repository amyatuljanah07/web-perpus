@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Permintaan Peminjaman</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Siswa</th>
                        <th>Buku</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $key => $request)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $request->siswa->name }}</td>
                        <td>{{ $request->book->title }}</td>
                        <td>{{ $request->status }}</td>
                        <td>
                            @if($request->status == 'pending')
                              <form action="{{ route('admin.borrow_requests.approve', $request->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui permintaan ini?')">
        Setujui
    </button>
</form>

                                <form action="{{ route('admin.borrow-requests.reject', $request->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
