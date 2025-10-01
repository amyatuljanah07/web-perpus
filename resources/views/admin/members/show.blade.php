<!DOCTYPE html>
<html>
<head>
    <title>Detail Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            background: #2c3e50;
            color: white;
            min-width: 250px;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.8);
            padding: 15px 25px;
            font-size: 1.1rem;
        }
        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255,255,255,.1);
        }
        .main-content {
            min-height: 100vh;
            background: #f8f9fa;
        }
        .top-navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h4 class="text-white mb-4 text-center">Dashboard Admin</h4>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door me-2"></i> Dashboard</a>
                <a class="nav-link" href="{{ route('admin.books.index') }}"><i class="bi bi-book me-2"></i> Buku</a>
                <a class="nav-link active" href="{{ route('admin.members.index') }}"><i class="bi bi-people me-2"></i> Members</a>
                <a class="nav-link" href="#"><i class="bi bi-arrow-left-right me-2"></i> Transactions</a>
                <a class="nav-link" href="#"><i class="bi bi-gear me-2"></i> Settings</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <nav class="top-navbar navbar navbar-expand px-4 py-3">
                <div class="container-fluid">
                    <h4 class="mb-0">Detail Siswa</h4>
                </div>
            </nav>

            <div class="container-fluid p-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">NIS</div>
                            <div class="col-md-9">{{ $member->nis }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Nama Lengkap</div>
                            <div class="col-md-9">{{ $member->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Kelas</div>
                            <div class="col-md-9">{{ $member->class }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Jurusan</div>
                            <div class="col-md-9">{{ $member->major }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Email</div>
                            <div class="col-md-9">{{ $member->email }}</div>
                        </div>
                        <div class="text-end mt-4">
                            <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
