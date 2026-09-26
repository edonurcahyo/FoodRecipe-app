<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cooking Recipes</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/x-icon">
</head>
<body>
    <div class="auth-layout">
        {{-- ===== Panel Kiri: Branding ===== --}}
        <aside class="auth-brand">
            <a href="/" class="auth-brand-logo">
                <span class="logo-icon">🍳</span>
                <span class="logo-text">Cooking Recipes</span>
            </a>

            <div class="auth-brand-content">
                <h2 class="auth-brand-title">Selamat Datang Kembali! 👋</h2>
                <p class="auth-brand-subtitle">
                    Masuk untuk melanjutkan menjelajahi koleksi resep favoritmu.
                </p>

                <ul class="auth-brand-features">
                    <li><span>📖</span> Simpan resep favoritmu</li>
                    <li><span>🔍</span> Cari ribuan inspirasi masakan</li>
                    <li><span>✍️</span> Bagikan resep andalanmu</li>
                </ul>
            </div>

            <p class="auth-brand-footer">
                &copy; {{ date('Y') }} Cooking Recipes. All rights reserved.
            </p>
        </aside>

        {{-- ===== Panel Kanan: Form ===== --}}
        <main class="auth-form-wrap">
            <div class="auth-card">
                <header class="auth-card-header">
                    <h1 class="auth-title">Login</h1>
                    <p class="auth-subtitle">Masuk ke akunmu untuk melanjutkan</p>
                </header>

                @if (session('error'))
                    <div class="auth-alert auth-alert-error">
                        <span>⚠️</span>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="auth-alert auth-alert-error">
                        <span>⚠️</span>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.process') }}" class="auth-form">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Username</label>
                        <div class="input-wrap">
                            <span class="input-icon">👤</span>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                placeholder="Masukkan username"
                                value="{{ old('name') }}"
                                required
                                autofocus
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-wrap">
                            <span class="input-icon">🔒</span>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                required
                            >
                            <button type="button" class="toggle-password" data-target="password" aria-label="Tampilkan password">
                                👁️
                            </button>
                        </div>
                    </div>

                    <div class="form-extras">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember">
                            <span>Ingat saya</span>
                        </label>
                        <a href="#" class="link-muted">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn-auth">
                        Masuk
                    </button>
                </form>

                <p class="auth-footer-text">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="link-primary">Daftar sekarang</a>
                </p>
            </div>
        </main>
    </div>

    <script>
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const target = document.getElementById(btn.dataset.target);
                if (!target) return;
                const isPassword = target.type === 'password';
                target.type = isPassword ? 'text' : 'password';
                btn.textContent = isPassword ? '🙈' : '👁️';
            });
        });
    </script>
</body>
</html>