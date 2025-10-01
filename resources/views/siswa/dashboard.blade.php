<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
            min-height: 100vh;
        }
        /* Sidebar style sama seperti admin */
        #sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: 250px;
            background-color: #1e2a38;
            color: #cfd8dc;
            transition: width 0.3s ease;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            z-index: 1040;
        }
        #sidebar.collapsed {
            width: 70px;
        }
        #sidebar .sidebar-header {
            padding: 1.5rem 1.5rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: #ffffff;
            border-bottom: 1px solid #2c3e50;
            text-align: center;
        }
        #sidebar.collapsed .sidebar-header span {
            display: none;
        }
        #sidebar nav a {
            display: flex;
            align-items: center;
            padding: 0.9rem 1.5rem;
            color: #cfd8dc;
            text-decoration: none;
            font-weight: 500;
            border-left: 4px solid transparent;
            border-radius: 0;
            margin-bottom: 0;
            transition: background-color 0.2s, border-color 0.2s;
        }
        #sidebar nav a:hover,
        #sidebar nav a.active {
            background-color: #16222a;
            border-left: 4px solid #0d6efd;
            color: #ffffff;
        }
        #sidebar nav a i {
            font-size: 1.3rem;
            margin-right: 1rem;
            min-width: 24px;
            text-align: center;
        }
        #sidebar.collapsed nav a span {
            display: none;
        }
        .main-content {
            min-height: 100vh;
            background: transparent;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }
        @media (max-width: 991px) {
            #sidebar {
                min-width: 70px;
                width: 70px;
                padding: 10px 0;
            }
            #sidebar .sidebar-header span {
                display: none;
            }
            #sidebar nav a span {
                display: none;
            }
            .main-content {
                margin-left: 70px;
            }
        }
        .top-navbar {
            background: rgba(255,255,255,0.95);
            box-shadow: 0 2px 10px rgba(44,62,80,.07);
            border-radius: 0 0 16px 16px;
        }
        .stat-card {
            background: linear-gradient(135deg, #fff 70%, #e0eafc 100%);
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(44,62,80,.08);
            padding: 24px 20px;
            margin-bottom: 24px;
            transition: box-shadow .2s;
            border: none;
        }
        .stat-card:hover {
            box-shadow: 0 8px 32px rgba(44,62,80,.13);
        }
        .stat-icon {
            font-size: 2.5rem;
            color: #2c3e50;
            opacity: 0.85;
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(44,62,80,.08);
        }
        .card-header {
            border-bottom: 1px solid rgba(44,62,80,.08);
            background: transparent;
            border-radius: 16px 16px 0 0;
        }
        .badge {
            padding: 0.5em 1em;
            font-size: 0.95em;
            border-radius: 8px;
        }
        .card img {
            height: 100%;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
        }
        .book-card {
            transition: transform .18s, box-shadow .18s;
            border-radius: 16px;
        }
        .book-card:hover {
            transform: translateY(-6px) scale(1.04);
            box-shadow: 0 8px 32px rgba(44,62,80,.13);
        }
        .modal-content {
            border-radius: 18px;
        }
        .modal-header {
            border-radius: 18px 18px 0 0;
            background: #f8f9fa;
        }
        .modal-body img {
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(44,62,80,.08);
        }
        .pagination .page-link {
            border-radius: 8px !important;
            margin: 0 2px;
            color: #2c3e50;
            border: none;
            background: #f4f6fb;
            transition: background .2s, color .2s;
        }
        .pagination .page-item.active .page-link {
            background: #2c3e50;
            color: #fff;
            font-weight: 600;
        }
        .pagination .page-link:hover {
            background: #d6e0f5;
            color: #2c3e50;
        }
        /* Responsive tweaks */
        @media (max-width: 991px) {
            #sidebar {
                min-width: 70px;
                width: 70px;
                padding: 10px 0;
            }
            #sidebar .sidebar-header span {
                display: none;
            }
            #sidebar nav a span {
                display: none;
            }
            .main-content {
                margin-left: 70px;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="">
            <div class="sidebar-header">
                <i class="bi bi-book-half"></i> <span>Perpustakaan</span>
            </div>
            <nav>
                <a class="nav-link active" href="{{ route('siswa.dashboard') }}"><i class="bi bi-house-door"></i> <span>Dashboard</span></a>
                <a class="nav-link" href="{{ route('siswa.riwayat') }}"><i class="bi bi-clock-history"></i> <span>Riwayat Peminjaman</span></a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <!-- Top Navbar -->
            <nav class="top-navbar navbar navbar-expand px-4 py-3 mb-3">
                <div class="container-fluid">
                    <h4 class="mb-0 fw-bold text-primary">Dashboard Siswa</h4>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle rounded-pill shadow-sm" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> {{ $nama }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('siswa.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Dashboard Content -->
            <div class="container-fluid p-4">
                @foreach($borrowHistory as $borrow)
                    @if($borrow->status === 'Dipinjam' && \Carbon\Carbon::now()->gt($borrow->due_date))
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            <strong>Peringatan!</strong> Buku "{{ $borrow->book->title }}" sudah melewati batas waktu pengembalian.
                            Segera kembalikan untuk menghindari denda tambahan (Rp 5.000/hari).
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif($borrow->status === 'Dipinjam' && \Carbon\Carbon::now()->diffInDays($borrow->due_date) <= 1)
                        <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                            <strong>Perhatian!</strong> Buku "{{ $borrow->book->title }}" harus dikembalikan dalam 1 hari.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                @endforeach
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="stat-card d-flex flex-column align-items-start">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div>
                                    <h6 class="text-muted mb-1">Buku Dipinjam</h6>
                                    <h3 class="mb-0 fw-bold text-primary">{{ $totalCurrentBorrowings }}</h3>
                                </div>
                                <i class="bi bi-book stat-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card d-flex flex-column align-items-start">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div>
                                    <h6 class="text-muted mb-1">Tenggat Waktu</h6>
                                    <h3 class="mb-0 fw-bold 
    @if($nearestDueDate < 0) text-danger @else text-primary @endif">
    @if($nearestDueDate === null)
        -
    @elseif($nearestDueDate < 0)
        <span class="text-danger">Terlambat {{ abs($nearestDueDate) }} Hari</span>
    @else
        {{ round($nearestDueDate) }} Hari
    @endif
</h3>

                                </div>
                                <i class="bi bi-calendar stat-icon"></i>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-md-3">
                        <div class="stat-card d-flex flex-column align-items-start">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div>
                                    <h6 class="text-muted mb-1">Denda</h6>
                                    <h3 class="mb-0 fw-bold text-danger">Rp {{ number_format($totalFines, 0, ',', '.') }}</h3>
                                </div>
                                <i class="bi bi-cash stat-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Book Catalog Section -->
                <div class="container-fluid p-0">
                    <div class="card mb-4">
                        <div class="card-header bg-white py-3">
                            <div class="row align-items-center g-2">
                                <div class="col">
                                    <h5 class="mb-0 fw-bold text-primary">Katalog Buku</h5>
                                </div>
                                <div class="col-auto">
                                    <form method="GET" class="d-flex align-items-center gap-2">
                                        <select class="form-select form-select-sm" name="category" onchange="this.form.submit()">
                                            <option value="">Semua Kategori</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                                    {{ $category }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                                <div class="col-4">
                                    <form class="d-flex gap-2" method="GET">
                                        <input type="text" 
                                               name="search" 
                                               class="form-control form-control-sm rounded-pill" 
                                               placeholder="Cari judul, penulis..."
                                               value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                @foreach($books as $book)
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="card h-100 book-card">
                                        <div class="position-relative">
                                            <img src="{{ $book->cover_url ? asset('storage/'.$book->cover_url) : 'https://via.placeholder.com/150x200' }}" 
                                                 class="card-img-top" alt="Cover {{ $book->title }}"
                                                 style="height: 250px; object-fit: cover;">
                                            <div class="position-absolute top-0 end-0 m-2">
                                                <span class="badge bg-{{ $book->status == 'Tersedia' ? 'success' : 'warning' }}">
                                                    {{ $book->status }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title h6 fw-bold text-primary">{{ $book->title }}</h5>
                                            <p class="text-muted small mb-2">{{ $book->author }}</p>
                                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                                <span class="badge bg-light text-dark border border-primary">{{ $book->category }}</span>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" 
                                                            data-bs-toggle="modal" data-bs-target="#bookModal{{ $book->id }}">
                                                        Detail
                                                    </button>
                                                    @if($book->status == 'Tersedia' && $book->stock > 0)
                                                        <form action="{{ route('siswa.books.borrow', $book->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-primary rounded-pill">
                                                                Pinjam
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-sm btn-primary rounded-pill" disabled>
                                                            Pinjam
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Book Detail Modal -->
                                <div class="modal fade" id="bookModal{{ $book->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold text-primary">{{ $book->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex gap-3 mb-3">
                                                    <img src="{{ $book->cover_url ? asset('storage/'.$book->cover_url) : 'https://via.placeholder.com/150x200' }}" 
                                                         alt="Cover" style="width: 150px; height: 200px; object-fit: cover;">
                                                    <div>
                                                        <h6 class="fw-bold">Penulis</h6>
                                                        <p class="text-muted">{{ $book->author }}</p>
                                                        <h6 class="fw-bold">Genre</h6>
                                                        <p class="text-muted">{{ $book->genre ?: 'Tidak tersedia' }}</p>
                                                        <h6 class="fw-bold">Kategori</h6>
                                                        <p class="text-muted">{{ $book->category }}</p>
                                                        <h6 class="fw-bold">Tahun Terbit</h6>
                                                        <p class="text-muted">{{ $book->year ?: 'Tidak tersedia' }}</p>
                                                        <h6 class="fw-bold">Jumlah Halaman</h6>
                                                        <p class="text-muted">{{ $book->pages ? $book->pages . ' halaman' : 'Tidak tersedia' }}</p>
                                                        <h6 class="fw-bold">Status</h6>
                                                        <span class="badge bg-{{ $book->status == 'Tersedia' ? 'success' : 'warning' }}">
                                                            {{ $book->status }}
                                                        </span>
                                                        <h6 class="fw-bold mt-2">Stok</h6>
                                                        <p class="text-muted">{{ $book->stock }} buku tersedia</p>
                                                    </div>
                                                </div>
                                                <h6 class="fw-bold">Sinopsis</h6>
                                                <p class="text-muted" style="white-space: pre-line;">{{ $book->synopsis }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                           <!-- Pagination -->
@if ($books->hasPages())
    <nav aria-label="Navigasi halaman buku">
        <ul class="pagination justify-content-end mt-3">
            {{-- Tombol Previous --}}
            <li class="page-item {{ $books->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Sebelumnya" tabindex="-1">
                    &laquo;
                </a>
            </li>
            {{-- Nomor Halaman --}}
            @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                <li class="page-item {{ $books->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
            {{-- Tombol Next --}}
            <li class="page-item {{ !$books->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Berikutnya">
                    &raquo;
                </a>
            </li>
        </ul>
    </nav>
@endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Optional: Sidebar collapse toggle (if you want to add a toggle button)
        // Example: Add a button with id="toggleSidebar" in your top-navbar
        // document.getElementById('toggleSidebar').onclick = function() {
        //     document.getElementById('sidebar').classList.toggle('collapsed');
        //     document.querySelector('.main-content').classList.toggle('collapsed');
        // };
    </script>
</body>
</html>
