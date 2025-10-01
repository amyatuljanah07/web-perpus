<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Perpustakaan SMKN 40 Jakarta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9fbfd;
      scroll-behavior: smooth;
    }

    .navbar-custom {
      background-color: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(8px);
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      transition: all 0.3s ease;
    }

    .navbar-brand img {
      height: 40px;
      margin-right: 10px;
    }

    .nav-btn {
      margin-left: 10px;
    }

    .hero-section {
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("Images/40 biru.jpg") }}') center center / cover no-repeat;
      min-height: 90vh;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .hero-title {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    .stats-section {
      margin-top: -60px;
      z-index: 10;
      position: relative;
    }

    .stat-card {
      background: white;
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 10px 25px rgba(0,0,0,0.05);
      transition: transform 0.3s;
    }

    .stat-card:hover {
      transform: translateY(-5px);
    }

    .stat-number {
      font-size: 2rem;
      font-weight: 700;
      color: #1a365d;
    }

    .stat-label {
      color: #6b7280;
    }

    .features-section {
      padding: 5rem 0;
      background-color: #fff;
    }

    .section-title {
      font-size: 2rem;
      font-weight: 700;
      color: #1a365d;
      position: relative;
      text-align: center;
    }

    .section-title::after {
      content: '';
      width: 60px;
      height: 4px;
      background-color: #4776E6;
      display: block;
      margin: 0.5rem auto 2rem auto;
      border-radius: 5px;
    }

    .feature-card {
      background-color: #f9fafc;
      border-radius: 16px;
      padding: 2rem;
      border: 1px solid #e5e7eb;
      transition: all 0.3s ease;
    }

    .feature-card:hover {
      box-shadow: 0 10px 25px rgba(0,0,0,0.07);
      transform: translateY(-5px);
    }

    .feature-icon {
      font-size: 2.5rem;
      color: #4776E6;
      margin-bottom: 1rem;
    }

    .feature-title {
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: #1a365d;
    }

    .feature-text {
      color: #4a5568;
      font-size: 0.95rem;
    }

    @media (max-width: 768px) {
      .hero-title {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-custom navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="{{ asset('Images/logo.png') }}" alt="Logo">
        <span class="fw-bold text-primary">SMKN 40 Jakarta</span>
      </a>
      <div class="ms-auto">
        <a href="{{ route('admin.login') }}" class="btn btn-outline-primary nav-btn">
          <i class="bi bi-person-badge me-1"></i> Login Admin
        </a>
        <a href="{{ route('siswa.register') }}" class="btn btn-primary nav-btn">
          <i class="bi bi-person-plus me-1"></i> Daftar Siswa
        </a>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero-section">
    <div class="container">
      <h1 class="hero-title">Perpustakaan Digital SMKN 40 Jakarta</h1>
      <p class="lead">Jelajahi ribuan koleksi buku dalam genggaman Anda</p>
    </div>
  </section>

  <!-- Stats -->
  <section class="stats-section py-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-3 col-sm-6">
          <div class="stat-card text-center">
            <i class="bi bi-book-half feature-icon"></i>
            <div class="stat-number">30</div>
            <div class="stat-label">Koleksi Buku</div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="stat-card text-center">
            <i class="bi bi-journal-text feature-icon"></i>
            <div class="stat-number">20+</div>
            <div class="stat-label">Kategori</div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="stat-card text-center">
            <i class="bi bi-people feature-icon"></i>
            <div class="stat-number">2</div>
            <div class="stat-label">Anggota Aktif</div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="stat-card text-center">
            <i class="bi bi-arrow-repeat feature-icon"></i>
            <div class="stat-number">10</div>
            <div class="stat-label">Peminjaman/Bulan</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Features -->
  <section class="features-section">
    <div class="container">
      <h2 class="section-title">Fitur Unggulan</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="feature-card text-center">
            <i class="bi bi-search feature-icon"></i>
            <h4 class="feature-title">Pencarian Cerdas</h4>
            <p class="feature-text">Temukan buku yang Anda butuhkan dengan cepat melalui sistem pencarian canggih.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card text-center">
            <i class="bi bi-bookmark-check feature-icon"></i>
            <h4 class="feature-title">Peminjaman Online</h4>
            <p class="feature-text">Pinjam buku secara online dan ambil di perpustakaan sesuai jadwal yang ditentukan.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-card text-center">
            <i class="bi bi-clock-history feature-icon"></i>
            <h4 class="feature-title">Riwayat & Notifikasi</h4>
            <p class="feature-text">Pantau peminjaman Anda dan dapatkan notifikasi pengembalian sebelum jatuh tempo.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>
</html>
