<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Cooking Recipes</title>

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
                <h2 class="auth-brand-title">Mulai Petualanganmu! 🚀</h2>
                <p class="auth-brand-subtitle">
                    Daftar gratis dan mulai simpan serta bagikan resep terbaikmu.
                </p>

                <ul class="auth-brand-features">
                    <li><span>✅</span> Gratis selamanya</li>
                    <li><span>✅</span> Simpan bookmark resep</li>
                    <li><span>✅</span> Akses ribuan resep</li>
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
                    <h1 class="auth-title">Daftar Akun</h1>
                    <p class="auth-subtitle">Buat akun baru dalam hitungan detik</p>
                </header>

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

                <form method="POST" action="{{ route('register.process') }}" class="auth-form">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Nama</label>
                        <div class="input-wrap">
                            <span class="input-icon">👤</span>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nama lengkapmu"
                                value="{{ old('name') }}"
                                required
                                autofocus
                            >
                        </div>
                        @error('name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-wrap">
                            <span class="input-icon">✉️</span>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="nama@email.com"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-wrap">
                            <span class="input-icon">🔒</span>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Minimal 8 karakter"
                                required
                            >
                            <button type="button" class="toggle-password" data-target="password" aria-label="Tampilkan password">
                                👁️
                            </button>
                        </div>
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <div class="input-wrap">
                            <span class="input-icon">🔒</span>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                                placeholder="Ulangi password"
                                required
                            >
                            <button type="button" class="toggle-password" data-target="password_confirmation" aria-label="Tampilkan password">
                                👁️
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-auth">
                        Daftar Sekarang
                    </button>
                </form>

                <p class="auth-footer-text">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="link-primary">Masuk di sini</a>
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