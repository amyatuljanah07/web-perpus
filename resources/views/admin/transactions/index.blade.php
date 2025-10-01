<!DOCTYPE html>
<html>
<head>
    <title>Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
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
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgb(0 0 0 / 0.1);
            border: none;
        }

        .nav-tabs {
            border-bottom: 2px solid #e9ecef;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 1rem 1.5rem;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 2px solid #0d6efd;
        }

        .table {
            margin: 0;
        }

        .table th {
            background: #f8fafc;
            color: #1e2a38;
            font-weight: 600;
            border-bottom: 2px solid #e3e6f0;
            padding: 1rem;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
            border-radius: 6px;
        }

        .btn-sm {
            font-weight: 500;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
        }

        .btn-success {
            background: #10b981;
            border: none;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar">
            <div class="sidebar-header">
                <i class="bi bi-book-half"></i> <span>Admin Dashboard</span>
            </div>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                    <i class="bi bi-book"></i> <span>Buku</span>
                </a>
                <a href="{{ route('admin.members.index') }}" class="{{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> <span>Members</span>
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="{{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-left-right"></i> <span>Transactions</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <nav class="top-navbar navbar navbar-expand px-4 py-3">
                <div class="container-fluid">
                    <h4 class="mb-0">Transactions</h4>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
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
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-4">
                            <li class="nav-item">
                                <a class="nav-link {{ !request('status') ? 'active' : '' }}" href="{{ route('admin.transactions.index') }}">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') === 'pending' ? 'active' : '' }}" href="{{ route('admin.transactions.index', ['status' => 'pending']) }}">Pending</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') === 'active' ? 'active' : '' }}" href="{{ route('admin.transactions.index', ['status' => 'active']) }}">Active</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request('status') === 'returned' ? 'active' : '' }}" href="{{ route('admin.transactions.index', ['status' => 'returned']) }}">Returned</a>
                            </li>
                        </ul>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Siswa</th>
                                        <th>Buku</th>
                                        <th>Status</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
    @foreach($transactions as $transaction)
    <tr>
        <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
       <td>
    @if ($transaction->siswa)
        {{ $transaction->siswa->nama }}
    @elseif ($transaction->siswa_id)
        <span class="text-warning">Siswa tidak ditemukan (ID: {{ $transaction->siswa_id }})</span>
    @else
        <span class="text-danger">Siswa tidak ditemukan (ID: kosong)</span>
    @endif
</td>
<td>
    @if ($transaction->book)
        {{ $transaction->book->title }}
    @else
        <span class="text-danger">Buku tidak ditemukan</span>
    @endif
</td>
<td>
    @if($transaction->status === 'pending')
        <form action="{{ route('admin.transactions.approve', $transaction->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary">Approve</button>
        </form>
    @endif

    @if($transaction->status !== 'returned')
        <form action="{{ route('admin.transactions.return', $transaction->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-success">Return</button>
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
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
