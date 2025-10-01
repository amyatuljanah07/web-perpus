<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(180deg, #1a237e 0%, #0d47a1 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 3.5rem;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 440px;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            margin: 0 auto;
            transform: translateY(-2vh);
        }

        .login-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #1a237e, #0d47a1);
        }

        .login-title {
            text-align: center;
            color: #1a237e;
            margin-bottom: 2.5rem;
            font-size: 2rem;
            font-weight: 700;
            position: relative;
        }

        .login-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #1a237e, #0d47a1);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            color: #1a237e;
            font-weight: 600;
            margin-bottom: 0.7rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-size: 1rem;
        }

        .form-label i {
            color: #0d47a1;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .form-control {
            padding: 1rem 1.2rem;
            font-size: 1rem;
            border: 2px solid #e0e7ff;
            border-radius: 10px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #1a237e;
            box-shadow: 0 0 0 0.25rem rgba(26, 35, 126, 0.15);
        }

        .form-group:focus-within i {
            transform: scale(1.1);
            color: #1a237e;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1a237e, #0d47a1);
            border: none;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 10px;
            letter-spacing: 1px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 35, 126, 0.4);
            background: linear-gradient(135deg, #0d47a1, #1a237e);
        }

        .alert {
            border: none;
            border-radius: 10px;
            background: rgba(220, 53, 69, 0.1);
            border-left: 4px solid #dc3545;
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2 class="login-title">Login Admin</h2>
            <!-- Menampilkan pesan error jika ada -->
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Form login -->
            <form method="POST" action="{{ url('/admin/login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-envelope"></i>Email
                    </label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-lock"></i>Password
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </button>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
