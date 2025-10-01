<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f5f7fa;
      margin: 0;
    }

    /* SIDEBAR */
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

    /* TOP NAVBAR */
    #topnav {
      position: fixed;
      top: 0; left: 250px; right: 0;
      height: 56px;
      background-color: #fff;
      border-bottom: 1px solid #e3e6f0;
      display: flex;
      align-items: center;
      padding: 0 1.5rem;
      justify-content: space-between;
      transition: left 0.3s ease;
      z-index: 1020;
    }
    #topnav.collapsed { left: 70px; }

    .toggle-btn {
      font-size: 1.5rem;
      color: #0d6efd;
      cursor: pointer;
    }

    /* MAIN CONTENT */
    #content {
      margin-left: 250px;
      padding: 80px 2rem 2rem;
      transition: margin-left 0.3s ease;
    }

    .container-fluid {
      padding: 1rem 2rem 2rem 2rem; /* Ubah padding atas dari 2rem ke 1rem */
    }

    .card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      border: none;
      margin-top: 1rem;
    }

    .card-header {
      background: white;
      padding: 1.5rem;
      border-bottom: 1px solid #e9ecef;
    }

    .card-body {
      padding: 1.5rem;
    }

    .row.book-grid {
      margin: 0 -0.75rem;
      row-gap: 1.5rem;
      /* display: flex;
      flex-wrap: wrap; */
      /* Gunakan default Bootstrap grid, tidak perlu display flex di sini */
    }

    .book-grid .col-sm-6,
    .book-grid .col-md-4,
    .book-grid .col-lg-3 {
      padding: 0 0.75rem;
      margin-bottom: 1.5rem;
      /* width: 100%; */ /* Jangan pakai width di sini */
    }
    
    @media (min-width: 576px) {
      .book-grid .col-sm-6 {
        width: 50%;
      }
    }
    
    @media (min-width: 768px) {
      .book-grid .col-md-4 {
        width: 33.333333%;
      }
    }
    
    @media (min-width: 992px) {
      .book-grid .col-lg-3 {
        width: 25%;
      }
    }

    .book-card {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .book-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgb(0 0 0 / 0.1);
      transition: transform 0.2s ease;
      border: none;
      overflow: hidden;
    }
    .book-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 30px rgb(0 0 0 / 0.15);
    }
    .card-body small {
      display: block;
      color: #6c757d;
      margin-bottom: 0.25rem;
    }

    .modal-body {
      max-height: 70vh;
      overflow-y: auto;
    }

    @media (max-width: 768px) {
      #sidebar { left: -250px; }
      #content, #topnav { margin-left: 0 !important; left: 0 !important; }
    }
  </style>
</head>
<body>
  <div class="d-flex">
    <!-- SIDEBAR -->
    <div id="sidebar" class="">
  <div class="sidebar-header">
    <i class="bi bi-book-half"></i> <span>Admin Dashboard</span>
  </div>
     <nav>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
    <a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books.*') ? 'active' : '' }}"><i class="bi bi-book"></i> <span>Buku</span></a>
    <a href="{{ route('admin.members.index') }}" class="{{ request()->routeIs('admin.members.*') ? 'active' : '' }}"><i class="bi bi-people"></i> <span>Members</span></a>
    <a href="{{ route('admin.transactions.index') }}" class="{{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}"><i class="bi bi-arrow-left-right"></i> <span>Transactions</span></a>
  </nav>
</div>
    <!-- MAIN CONTENT -->
    <div class="main-content" id="content">
      <!-- TOPNAV -->
      <nav id="topnav" class="shadow-sm">
        <i class="bi bi-list toggle-btn" onclick="toggleSidebar()"></i>
        <div class="user-info">
          <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle me-1"></i> Admin
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <form action="{{ route('admin.logout') }}" method="POST">@csrf
                  <button class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="container-fluid">
        <div class="card">
          <div class="card-header bg-white">
            <div class="row align-items-center">
              <div class="col-md-4">
                <h5 class="fw-semibold mb-0">Daftar Buku</h5>
              </div>
              <div class="col-md-4">
                <form action="{{ route('admin.books.index') }}" method="GET">
                  <select class="form-select" name="genre" onchange="this.form.submit()">
                    <option value="">Semua Genre</option>
                    <option value="Romantis" {{ request('genre') == 'Romantis' ? 'selected' : '' }}>Romantis</option>
                    <option value="Horror" {{ request('genre') == 'Horror' ? 'selected' : '' }}>Horror</option>
                    <option value="Self Development" {{ request('genre') == 'Self Development' ? 'selected' : '' }}>Self Development</option>
                    <option value="Misteri" {{ request('genre') == 'Misteri' ? 'selected' : '' }}>Misteri</option>
                    <option value="Petualangan" {{ request('genre') == 'Petualangan' ? 'selected' : '' }}>Petualangan</option>
                  </select>
                </form>
              </div>
              <div class="col-md-4 text-end">
                <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                  <i class="bi bi-plus-lg me-1"></i> Tambah Buku
                </a>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row book-grid">
              @forelse ($books as $book)
              <div class="col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                <div class="card book-card w-100">
                  <img src="{{ $book->cover_url ? asset('storage/'.$book->cover_url) : 'https://via.placeholder.com/150x200' }}" 
                       alt="Cover Buku" class="card-img-top" style="height: 200px; object-fit: cover;">
                  <div class="card-body">
                    <h6 class="card-title">{{ $book->title }}</h6>
                    <small>{{ $book->author }}</small>
                    <span class="badge bg-{{ $book->status == 'Tersedia' ? 'success' : 'secondary' }}">{{ $book->status }}</span>
                    <small>Stok: {{ $book->stock }}</small>
                    <small>{{ $book->category }}</small>
                    <small>{{ $book->genre ?: 'Genre tidak tersedia' }}</small>
                    <small>{{ $book->pages ? $book->pages.' hal.' : '' }}</small>
                  </div>
                  <div class="position-absolute top-0 end-0 m-2">
                    <div class="btn-group">
                      <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#synopsisModal{{ $book->id }}"><i class="bi bi-eye"></i></button>
                      <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
                      <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-light" onclick="return confirm('Yakin ingin menghapus buku ini?')"><i class="bi bi-trash"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal -->
              <div class="modal fade" id="synopsisModal{{ $book->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header" style="background:#f7f7fa; color:#23272b;">
                      <h5 class="modal-title">{{ $book->title }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                          <img src="{{ $book->cover_url ? asset('storage/'.$book->cover_url) : 'https://via.placeholder.com/150x200' }}" 
                               alt="Cover" style="width: 100%; max-width: 180px; height: 240px; object-fit: cover; border-radius: 10px; box-shadow: 0 2px 10px #e3e6f0;">
                        </div>
                        <div class="col-md-8">
                          <div class="mb-2">
                            <span class="fw-semibold text-primary"><i class="bi bi-person"></i> Penulis:</span>
                            <span class="ms-1">{{ $book->author }}</span>
                          </div>
                          <div class="mb-2">
                            <span class="fw-semibold text-primary"><i class="bi bi-bookmark"></i> Kategori:</span>
                            <span class="ms-1">{{ $book->category }}</span>
                          </div>
                          <div class="mb-2">
                            <span class="fw-semibold text-primary"><i class="bi bi-tag"></i> Genre:</span>
                            <span class="ms-1">{{ $book->genre ?: 'Tidak tersedia' }}</span>
                          </div>
                          <div class="mb-2">
                            <span class="fw-semibold text-primary"><i class="bi bi-file-earmark-text"></i> Jumlah Halaman:</span>
                            <span class="ms-1">{{ $book->pages ? $book->pages.' halaman' : 'Tidak tersedia' }}</span>
                          </div>
                          <div class="mb-2">
                            <span class="fw-semibold text-primary"><i class="bi bi-calendar"></i> Tahun Terbit:</span>
                            <span class="ms-1">{{ $book->year ?: 'Tidak tersedia' }}</span>
                          </div>
                          <div class="mb-2">
                            <span class="fw-semibold text-primary"><i class="bi bi-box"></i> Stok:</span>
                            <span class="ms-1">{{ $book->stock }}</span>
                          </div>
                          <div class="mb-2">
                            <span class="fw-semibold text-primary"><i class="bi bi-info-circle"></i> Status:</span>
                            <span class="badge bg-{{ $book->status == 'Tersedia' ? 'success' : 'secondary' }} ms-1">{{ $book->status }}</span>
                          </div>
                        </div>
                      </div>
                      <hr class="my-3">
                      <div>
                        <span class="fw-semibold text-primary"><i class="bi bi-journal-text"></i> Sinopsis</span>
                        <div class="mt-2" style="background:#f3f4f6;border-radius:8px;padding:1rem;">
                          <span style="white-space: pre-line;">{{ $book->synopsis }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @empty
              <div class="col-12 text-center py-5">
                <i class="bi bi-journal-x fs-1 text-muted"></i>
                <p class="mt-2">Tidak ada buku ditemukan.</p>
              </div>
              @endforelse
            </div>

            @if ($books->hasPages())
            <nav class="mt-4">
              <ul class="pagination justify-content-center">
                <li class="page-item {{ $books->onFirstPage() ? 'disabled' : '' }}">
                  <a class="page-link" href="{{ $books->previousPageUrl() }}">&laquo;</a>
                </li>
                @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                <li class="page-item {{ $books->currentPage() == $page ? 'active' : '' }}">
                  <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
                @endforeach
                <li class="page-item {{ !$books->hasMorePages() ? 'disabled' : '' }}">
                  <a class="page-link" href="{{ $books->nextPageUrl() }}">&raquo;</a>
                </li>
              </ul>
            </nav>
            @endif
          </div>
        </div>
      </div>

      <!-- Mobile Add Button -->
      <a href="{{ route('admin.books.create') }}" class="btn btn-primary d-md-none position-fixed bottom-0 end-0 m-4 shadow">
        <i class="bi bi-plus-lg"></i>
      </a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const topnav = document.getElementById('topnav');
      const content = document.getElementById('content');
      sidebar.classList.toggle('collapsed');
      topnav.classList.toggle('collapsed');
      content.classList.toggle('collapsed');
    }
  </script>
</body>
</html>
