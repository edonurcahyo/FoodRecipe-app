<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Cooking Recipes')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    @stack('styles')

    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/x-icon">
    <script src="{{ asset('js/theme.js') }}" defer></script>
</head>
<body>
    <header>
        <div class="navbar">
            <a href="{{ auth()->check() ? route('home') : route('index') }}" class="logo">
                <span class="logo-icon">🍳</span>
                <span class="logo-text">Cooking Recipes</span>
            </a>

            <button class="nav-toggle" id="nav-toggle" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="nav-menu" id="nav-menu">
                @auth
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('search-recipe') }}" class="nav-link {{ request()->routeIs('search-recipe') ? 'active' : '' }}">Pencarian Resep</a>
                    <a href="{{ route('bookmark.index') }}" class="nav-link {{ request()->routeIs('bookmark.*') ? 'active' : '' }}">Bookmark</a>

                    <form action="{{ route('logout') }}" method="POST" class="inline-form">
                        @csrf
                        <button type="submit" class="nav-link nav-link-logout">Logout</button>
                    </form>
                @else
                    <a href="{{ route('index') }}" class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-link nav-link-cta">Register</a>
                @endauth

                <button id="theme-toggle" class="theme-toggle" aria-label="Toggle theme">
                    <span class="icon-sun">☀️</span>
                    <span class="icon-moon">🌙</span>
                </button>
            </nav>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <script src="{{ asset('js/nav.js') }}"></script>
    @stack('scripts')
</body>
</html>