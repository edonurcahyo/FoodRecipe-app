<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <form method="POST" action="/register">
            @csrf 
            <h1>Register</h1>
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: red;">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="input-box">
                <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}" required>
                <i class='bx bxs-user'></i>
            </div>
            
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <i class='bx bxs-envelope'></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="input-box">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <button type="submit" class="btn">Register</button>

            <div class="register-link">
                <p>Already have an account? 
                    <a href="/login"> <b>Login</b></a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>
