<!DOCTYPE html>
<html>
<head>
    <title>Admin - Buku</title>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f4f4f4; }
        nav a, nav form { margin-right: 10px; display: inline-block; }
    </style>
</head>
<body>
    <h1>Admin Panel</h1>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.books') }}">Daftar Buku</a>
        <form method="POST" action="{{ route('admin.logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>
    <hr>
    @yield('content')
</body>
</html>
