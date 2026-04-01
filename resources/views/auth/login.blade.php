<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Informasi Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            background-color: #b9b9c3;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: #fff;
            width: 400px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        .login-card h2 {
            margin-bottom: 5px;
            font-weight: 600;
        }

        .login-card p {
            margin-bottom: 30px;
            color: #666;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: linear-gradient(to right, #4e00ff, #2b00ff);
            color: #fff;
            font-weight: 500;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-login:hover {
            opacity: 0.9;
        }

        .register-link {
            margin-top: 15px;
            font-size: 13px;
            color: #555;
        }

        .register-link a {
            text-decoration: none;
            font-weight: 500;
            color: #000;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>Sistem Informasi<br>Perpustakaan</h2>
        <p>Login akun</p>

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukan email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>

        <div class="register-link">
            Belum punya akun ? <a href="{{ route('register') }}">Daftar</a>
        </div>
    </div>

</body>
</html>
