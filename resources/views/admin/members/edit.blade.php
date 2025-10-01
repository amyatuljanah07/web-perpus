<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa</title>
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
                    <h4 class="mb-0">Edit Siswa</h4>
                </div>
            </nav>

            <div class="container-fluid p-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.members.update', $member->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">NIS</label>
                                    <input type="text" class="form-control" name="nis" value="{{ $member->nis }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="name" value="{{ $member->name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kelas</label>
                                    <input type="text" class="form-control" name="class" value="{{ $member->class }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jurusan</label>
                                    <select class="form-select" name="major" required>
                                        <option value="">Pilih Jurusan</option>
                                        <option value="RPL" {{ $member->major == 'RPL' ? 'selected' : '' }}>RPL</option>
                                        <option value="MP" {{ $member->major == 'MP' ? 'selected' : '' }}>MP</option>
                                        <option value="DKV" {{ $member->major == 'DKV' ? 'selected' : '' }}>DKV</option>
                                        <option value="AKL" {{ $member->major == 'AKL' ? 'selected' : '' }}>AKL</option>
                                        <option value="BR" {{ $member->major == 'BR' ? 'selected' : '' }}>BR</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $member->email }}" required>
                                </div>
                            </div>
                            <div class="text-end mt-4">
                                <a href="{{ route('admin.members.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
