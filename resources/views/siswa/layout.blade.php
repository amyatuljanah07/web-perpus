<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Perpustakaan Digital')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
            min-height: 100vh;
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
            z-index: 1040;
        }
        #sidebar.collapsed { width: 70px; }
        #sidebar .sidebar-header {
            padding: 1.5rem 1.5rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: #ffffff;
            border-bottom: 1px solid #2c3e50;
            text-align: center;
        }
        #sidebar.collapsed .sidebar-header span { display: none; }
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
        #sidebar.collapsed nav a span { display: none; }
        .main-content {
            min-height: 100vh;
            background: transparent;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }
        .top-navbar {
            background: rgba(255,255,255,0.95);
            box-shadow: 0 2px 10px rgba(44,62,80,.07);
            border-radius: 0 0 16px 16px;
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
        @media (max-width: 991px) {
            #sidebar {
                min-width: 70px;
                width: 70px;
                padding: 10px 0;
            }
            #sidebar .sidebar-header span,
            #sidebar nav a span { display: none; }
            .main-content { margin-left: 70px; }
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
                <a class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}" 
                   href="{{ route('siswa.dashboard') }}">
                   <i class="bi bi-house-door"></i> <span>Dashboard</span>
                </a>
                <a class="nav-link {{ request()->routeIs('siswa.riwayat') ? 'active' : '' }}" 
                   href="{{ route('siswa.riwayat') }}">
                   <i class="bi bi-clock-history"></i> <span>Riwayat Peminjaman</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <!-- Top Navbar -->
            <nav class="top-navbar navbar navbar-expand px-4 py-3 mb-3">
                <div class="container-fluid">
                    <h4 class="mb-0 fw-bold text-primary">@yield('page-title')</h4>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle rounded-pill shadow-sm" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::guard('siswa')->user()->nama ?? 'Siswa' }}

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

            <!-- Content Area -->
            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
