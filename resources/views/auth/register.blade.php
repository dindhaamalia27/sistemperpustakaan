<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar - Sistem Informasi Perpustakaan</title>
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

        .register-card {
            background: #fff;
            width: 400px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-align: center;
        }

        .register-card h2 {
            margin-bottom: 5px;
            font-weight: 600;
        }

        .register-card p {
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

        .btn-register {
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

        .btn-register:hover {
            opacity: 0.9;
        }

        .login-link {
            margin-top: 15px;
            font-size: 13px;
            color: #555;
        }

        .login-link a {
            text-decoration: none;
            font-weight: 500;
            color: #000;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="register-card">
    <h2>Sistem Informasi<br>Perpustakaan</h2>
    <p>Buat akun</p>

    <form action="{{ route('register.proses') }}" method="POST">
        @csrf
       <!-- TAMBAHKAN DI SINI -->
             <div class="form-group">
              <label>Nama</label>
             <input type="text" name="name" class="form-control" required>
              @error('name')
            <div class="error">{{ $message }}</div>
           @enderror
          </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Konfirmasi password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn-register">Daftar</button>
    </form>

    <div class="login-link">
        Sudah punya akun ? <a href="{{ route('login') }}">Masuk</a>
    </div>
</div>

</body>
</html>
