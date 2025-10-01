<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f5f7fa;
      margin: 0;
    }
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
    #content {
      margin-left: 250px;
      padding: 80px 2rem 2rem;
      transition: margin-left 0.3s ease;
    }
    .card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      border: none;
      margin-top: 0.5rem;
    }
    .card-body {
      padding: 1.5rem;
    }
    .form-label {
      font-weight: 500;
      color: #1e2a38;
    }
    .btn-primary {
      background-color: #0d6efd;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0b5ed7;
    }
    .btn-secondary {
      background-color: #6c757d;
      border: none;
    }
    .btn-secondary:hover {
      background-color: #565e64;
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
        <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
        <a href="{{ route('admin.books.index') }}" class="active"><i class="bi bi-book"></i> <span>Buku</span></a>
        <a href="{{ route('admin.members.index') }}"><i class="bi bi-people"></i> <span>Members</span></a>
        <a href="{{ route('admin.transactions.index') }}"><i class="bi bi-arrow-left-right"></i> <span>Transactions</span></a>
      </nav>
    </div>
    <!-- MAIN CONTENT -->
    <div class="main-content flex-grow-1" id="content">
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
      <div class="container-fluid" style="padding:0 2rem 1.5rem 2rem;">
        <div class="card">
          <div class="card-header bg-white">
            <h5 class="fw-semibold mb-0">Tambah Buku</h5>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-4 mb-3">
                  <div class="text-center">
                    <img id="coverPreview" src="https://via.placeholder.com/300x400"
                         class="img-fluid rounded mb-3" alt="Book Cover" style="max-height: 300px;">
                    <div class="mb-3">
                      <label class="form-label">Cover Buku</label>
                      <input type="file" class="form-control" name="cover" accept="image/*" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label">Judul Buku</label>
                      <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Penulis</label>
                      <input type="text" class="form-control" name="author" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Kategori</label>
                      <select class="form-select" name="category" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Fiksi">Fiksi</option>
                        <option value="Non-Fiksi">Non-Fiksi</option>
                        <option value="Pendidikan">Pendidikan</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Genre</label>
                      <input type="text" class="form-control" name="genre" placeholder="Contoh: Romance, Horror, dll">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Jumlah Halaman</label>
                      <input type="number" class="form-control" name="pages" placeholder="Masukkan jumlah halaman">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Status</label>
                      <select class="form-select" name="status" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Dipinjam">Dipinjam</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Tahun Terbit</label>
                      <input type="number" class="form-control" name="year">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Stok</label>
                      <input type="number" class="form-control" name="stock" value="1">
                    </div>
                    <div class="col-12">
                      <label class="form-label">Sinopsis</label>
                      <textarea class="form-control" name="synopsis" rows="4" required></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-end mt-4">
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Buku</button>
              </div>
            </form>
          </div>
        </div>
      </div>
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
    document.querySelector('input[name="cover"]').addEventListener('change', function(e) {
      if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('coverPreview').src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
      }
    });
  </script>
</body>
</html>
