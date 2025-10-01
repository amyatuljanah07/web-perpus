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
    padding: 20px;
    }

    #sidebar .nav-link {
    color: #b0bec5;
    }

    #sidebar .nav-link.active {
    color: #ffffff;
    background-color: #007bff;
    }

    #sidebar .nav-link:hover {
    color: #ffffff;
    }

    /* CONTENT */
    #content {
    margin-left: 250px;
    padding: 20px;
    }

    /* FOOTER */
    footer {
    background-color: #1e2a38;
    color: #b0bec5;
    text-align: center;
    padding: 10px 0;
    position: relative;
    bottom: 0;
    width: 100%;
    }
  </style>
</head>
<body>

  <!-- SIDEBAR -->
  <div id="sidebar">
    <h2 class="text-white">Perpustakaan</h2>
    <div class="mb-4">
      <a href="#" class="btn btn-primary w-100">Tambah Buku</a>
    </div>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" href="#">
          <i class="bi bi-house-door"></i>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="bi bi-book"></i>
          Daftar Buku
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="bi bi-person"></i>
          Anggota
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="bi bi-gear"></i>
          Pengaturan
        </a>
      </li>
    </ul>
  </div>

  <!-- CONTENT -->
  <div id="content">
    <div class="container">
      <h1 class="mb-4">Daftar Buku</h1>

      <div class="row mb-4">
        <div class="col-md-6">
          <form>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Cari buku...">
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </form>
        </div>
        <div class="col-md-6 text-end">
          <a href="#" class="btn btn-success">
            <i class="bi bi-file-earmark-spreadsheet"></i>
            Export
          </a>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Judul</th>
              <th>Pengarang</th>
              <th>Tahun Terbit</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($books as $book)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $book->title }}</td>
              <td>{{ $book->author }}</td>
              <td>{{ $book->year }}</td>
              <td>
                <a href="#" class="btn btn-warning btn-sm">
                  <i class="bi bi-pencil"></i>
                  Edit
                </a>
                <a href="#" class="btn btn-danger btn-sm">
                  <i class="bi bi-trash"></i>
                  Hapus
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="d-flex justify-content-between align-items-center">
        <div>
          Menampilkan {{ $books->firstItem() }} - {{ $books->lastItem() }} dari {{ $books->total() }} buku
        </div>
        <div>
          {{ $books->links() }}
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer>
    &copy; 2023 Perpustakaan. All rights reserved.
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>