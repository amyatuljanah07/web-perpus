<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f5f7fa;
      margin: 0;
    }

    /* Sidebar */
    #sidebar {
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
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

    /* Navbar */
    #topnav {
      position: fixed;
      top: 0;
      left: 250px;
      right: 0;
      height: 56px;
      background-color: #ffffff;
      border-bottom: 1px solid #e3e6f0;
      display: flex;
      align-items: center;
      padding: 0 1.5rem;
      justify-content: space-between;
      transition: left 0.3s ease;
      z-index: 1030;
    }

    #topnav.collapsed {
      left: 70px;
    }

    #topnav .toggle-btn {
      font-size: 1.5rem;
      color: #0d6efd;
      cursor: pointer;
    }

    #topnav .user-info {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      font-weight: 600;
      color: #343a40;
    }

    #topnav .user-info img {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      object-fit: cover;
    }

    /* Main content */
    #content {
      margin-top: 56px;
      margin-left: 250px;
      padding: 2rem;
      transition: margin-left 0.3s ease;
    }

    #content.collapsed {
      margin-left: 70px;
    }

    /* Cards */
    .card-stat {
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgb(0 0 0 / 0.1);
      padding: 1.5rem 2rem;
      position: relative;
      overflow: hidden;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-stat:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 30px rgb(0 0 0 / 0.15);
    }

    .card-stat .label {
      font-size: 0.85rem;
      font-weight: 600;
      color: #6c757d;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      margin-bottom: 0.3rem;
    }

    .card-stat .value {
      font-size: 2.6rem;
      font-weight: 700;
      color: #0d6efd;
      margin-bottom: 0.3rem;
    }

    .card-stat .change {
      font-weight: 600;
      color: #198754;
      display: flex;
      align-items: center;
      gap: 0.3rem;
    }

    .card-stat .change.negative {
      color: #dc3545;
    }

    .card-stat .icon-bg {
      position: absolute;
      bottom: 1rem;
      right: 1.5rem;
      font-size: 4rem;
      color: #0d6efd22;
      user-select: none;
    }

    /* Table */
    .table-card {
      background-color: #ffffff;
      border-radius: 12px;
      padding: 1.5rem 2rem;
      box-shadow: 0 4px 15px rgb(0 0 0 / 0.1);
    }

    .table-card h5 {
      color: #0d6efd;
      font-weight: 700;
      margin-bottom: 1.2rem;
    }

    .table thead th {
      border-bottom: none;
      background-color: #e9f0ff;
      color: #0d6efd;
      font-weight: 600;
    }

    .table tbody tr:hover {
      background-color: #f1f7ff;
    }

    .btn-sm {
      font-weight: 600;
      border-radius: 8px;
      padding: 0.3rem 0.9rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      #sidebar {
        position: fixed;
        width: 200px;
        z-index: 1050;
        left: -200px;
        transition: left 0.3s ease;
      }

      #sidebar.collapsed {
        left: 0;
        width: 200px;
      }

      #topnav {
        left: 0 !important;
      }

      #content {
        margin-left: 0 !important;
      }
    }
  </style>
</head>

<body>

  <!-- Sidebar -->
  <div id="sidebar" class="">
    <div class="sidebar-header">
      <i class="bi bi-book-half"></i> <span>Admin Dashboard</span>
    </div>
    <nav>
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i
          class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
      <a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books.*') ? 'active' : '' }}"><i
          class="bi bi-book"></i> <span>Buku</span></a>
      <a href="{{ route('admin.members.index') }}"
        class="{{ request()->routeIs('admin.members.*') ? 'active' : '' }}"><i class="bi bi-people"></i>
        <span>Members</span></a>
      <a href="{{ route('admin.transactions.index') }}"
        class="{{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}"><i class="bi bi-arrow-left-right"></i>
        <span>Transactions</span></a>
    </nav>
  </div>

  <!-- Top Navbar -->
  <div id="topnav" class="">
    <div class="toggle-btn" id="toggleSidebar">
      <i class="bi bi-list"></i>
    </div>
    <div class="user-info dropdown">
      <img src="https://ui-avatars.com/api/?name={{ urlencode($name) }}" alt="Avatar" />
      <button class="btn btn-link dropdown-toggle text-decoration-none text-dark" type="button"
        data-bs-toggle="dropdown" aria-expanded="false">
        {{ $name }}
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="dropdown-item d-flex align-items-center">
              <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>

  <!-- Main Content -->
  <div id="content">
    <div class="row g-4 mb-4">
  <div class="col-md-3 d-flex">
    <div class="card-stat h-100 w-100">
      <div class="label">Total Books</div>
      <div class="value">{{ $totalBooks }}</div>
      <div class="change"><i class="bi bi-arrow-up"></i> +{{ $newBooksThisMonth }} this month</div>
      <i class="bi bi-book icon-bg"></i>
    </div>
  </div>
  <div class="col-md-3 d-flex">
    <div class="card-stat h-100 w-100">
      <div class="label">Active Borrowings</div>
      <div class="value">{{ $borrowedBooks }}</div>
      <div class="change"><i class="bi bi-arrow-up"></i> 12 new today</div>
      <i class="bi bi-bookmark-check icon-bg"></i>
    </div>
  </div>
  <div class="col-md-3 d-flex">
    <div class="card-stat h-100 w-100">
      <div class="label">Overdue Books</div>
      <div class="value">{{ $overdueBooks }}</div>
      <div class="change negative">Need attention</div>
      <i class="bi bi-exclamation-triangle icon-bg"></i>
    </div>
  </div>
  <div class="col-md-3 d-flex">
    <div class="card-stat h-100 w-100">
      <div class="label">Available Books</div>
      <div class="value">{{ $availableBooks }}</div>
      <div class="change">63% of total</div>
      <i class="bi bi-collection icon-bg"></i>
    </div>
  </div>
</div>


    <div class="table-card">
      <h5>Permintaan Peminjaman Baru</h5>
      <div class="table-responsive">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>Siswa</th>
              <th>Buku</th>
              <th>Tanggal Request</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pendingRequests as $request)
            <tr>
                <td>{{ $request->siswa->nama }}</td>
                <td>{{ $request->book->title }}</td>
                <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if($request->status == 'pending')
                        <form action="{{ route('admin.borrow-requests.approve', $request->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Setujui</button>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const sidebar = document.getElementById('sidebar');
    const topnav = document.getElementById('topnav');
    const content = document.getElementById('content');
    const toggleBtn = document.getElementById('toggleSidebar');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
      topnav.classList.toggle('collapsed');
      content.classList.toggle('collapsed');
    });
  </script>
</body>

</html>