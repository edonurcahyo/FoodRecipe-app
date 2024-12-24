<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Login</h1>
            @if(session('error'))
                <p style="color:red;">{{ session('error') }}</p>
            @endif

            <div class="input-box">
                <input type="text" name="name" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>
    
            <button type="submit" class="btn">Login</button>
    
            <div class="register-link">
                <p>Don't have an account? 
                    <a href="/register"> <b>Register</b></a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>
