<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Siswa</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #0d6efd 0%, #6dd5ed 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
        }
        .login-box {
            background: #fff;
            padding: 2.7rem 2.2rem 2.2rem 2.2rem;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(13,110,253,0.10), 0 1.5px 8px #b6e0fe;
            width: 100%;
            max-width: 410px;
            position: relative;
            overflow: hidden;
        }
        .login-box::before {
            content: "";
            position: absolute;
            top: -60px; right: -60px;
            width: 120px; height: 120px;
            background: #e3f0ff;
            border-radius: 50%;
            z-index: 0;
        }
        .login-title {
            color: #0d6efd;
            text-align: center;
            margin-bottom: 2.2rem;
            font-weight: 800;
            font-size: 2rem;
            letter-spacing: -1px;
            position: relative;
            z-index: 1;
        }
        .form-floating {
            margin-bottom: 1.2rem;
        }
        .form-control {
            padding: 0.85rem 1.2rem;
            border-radius: 10px;
            border: 1.5px solid #e3e6f0;
            font-size: 1.08rem;
            background: #f8fafd;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 2px #e3f0ff;
            background: #fff;
        }
        .form-floating > label {
            color: #6c757d;
            font-size: 1rem;
            font-weight: 500;
        }
        .btn-login {
            background: linear-gradient(90deg, #0d6efd 60%, #6dd5ed 100%);
            border: none;
            padding: 0.85rem;
            font-size: 1.13rem;
            font-weight: 700;
            border-radius: 10px;
            box-shadow: 0 2px 12px #b6e0fe;
            transition: background 0.2s, box-shadow 0.2s;
        }
        .btn-login:hover {
            background: linear-gradient(90deg, #0b5ed7 60%, #3ec6e0 100%);
            box-shadow: 0 4px 18px #b6e0fe;
        }
        .register-link {
            text-align: center;
            margin-top: 1.7rem;
            font-size: 1.01rem;
        }
        .register-link a {
            color: #0d6efd;
            font-weight: 600;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .icon-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #0d6efd 60%, #6dd5ed 100%);
            border-radius: 50%;
            margin: 0 auto 1.2rem auto;
            color: #fff;
            font-size: 2rem;
            box-shadow: 0 2px 12px #b6e0fe;
        }
        .alert {
            font-size: 0.98rem;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center" style="min-height:100vh;">
        <div class="login-box mx-auto">
            <div class="icon-circle">
                <i class="bi bi-person-circle"></i>
            </div>
            <h2 class="login-title">Login Siswa</h2>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="/siswa/login">
                @csrf
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                    <label for="email"><i class="bi bi-envelope"></i> Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password"><i class="bi bi-lock"></i> Password</label>
                </div>
                <button type="submit" class="btn btn-login w-100 mt-2">Login</button>
            </form>

            <div class="register-link">
                <p class="text-muted mb-0">Belum punya akun? <a href="/siswa/register">Register di sini</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
