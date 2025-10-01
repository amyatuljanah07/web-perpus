<!DOCTYPE html>
<html>
<head>
    <title>Members</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
        }

        /* Sidebar */
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

        .main-content {
            margin-left: 250px;
            padding: 2rem;
            min-height: 100vh;
        }

        .top-navbar {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: 56px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,.05);
            z-index: 999;
            padding: 0 2rem;
        }

        .table-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 1.5rem 2rem;
            box-shadow: 0 4px 15px rgb(0 0 0 / 0.1);
        }

        .table thead th {
            border-bottom: none;
            background-color: #e9f0ff;
            color: #0d6efd;
            font-weight: 600;
            padding: 1rem;
        }

        .table tbody tr:hover {
            background-color: #f1f7ff;
        }

        .btn-sm {
            font-weight: 600;
            border-radius: 8px;
            padding: 0.4rem 0.8rem;
        }

        .btn-primary {
            background: #0d6efd;
            border: none;
            font-weight: 600;
            padding: 0.7rem 1.2rem;
            border-radius: 8px;
        }

        .modal-content {
            border-radius: 12px;
            border: none;
        }

        .modal-header {
            background: #0d6efd;
            color: white;
            border: none;
        }

        .modal-body h6 {
            color: #1e2a38;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
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

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <!-- Top Navbar -->
            <nav class="top-navbar navbar navbar-expand px-4 py-3">
                <div class="container-fluid">
                    <h4 class="mb-0">Members</h4>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> Admin
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('admin.logout') }}" method="POST">
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

            <!-- Content -->
            <div class="container-fluid p-4">
                <div class="card table-card">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Data Siswa</h5>
                        <a href="{{ route('admin.members.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i> Tambah Siswa
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
    <tr>
        <td>{{ $student->nis }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->class }}</td>
        <td>{{ $student->major }}</td>
        <td>{{ $student->email }}</td>
        <td class="text-center">
            <!-- Detail -->
            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $student->id }}">
                <i class="bi bi-eye"></i>
            </button>

            <!-- Edit -->
            <a href="{{ route('admin.members.edit', $student->id) }}" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil"></i>
            </a>

            <!-- Hapus -->
            <form action="{{ route('admin.members.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus data ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </td>
    </tr>



                                    <!-- Detail Modal -->
                                    <div class="modal fade" id="detailModal{{ $student->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Siswa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">NIS</h6>
                                                        <p>{{ $student->nis }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Nama Lengkap</h6>
                                                        <p>{{ $student->name }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Kelas</h6>
                                                        <p>{{ $student->class }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Jurusan</h6>
                                                        <p>{{ $student->major }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Email</h6>
                                                        <p>{{ $student->email }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6 class="fw-bold">Riwayat Peminjaman</h6>
                                                        @if($student->borrowings->count() > 0)
                                                            <ul class="list-unstyled">
                                                                @foreach($student->borrowings as $borrowing)
                                                                    <li class="mb-2">
                                                                        <span class="d-block">{{ $borrowing->book->title }}</span>
                                                                        <small class="text-muted">
                                                                            {{ $borrowing->borrow_date }} - 
                                                                            {{ $borrowing->return_date ?: 'Belum dikembalikan' }}
                                                                        </small>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <p class="text-muted">Belum pernah meminjam buku</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
