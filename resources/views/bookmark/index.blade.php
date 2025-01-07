<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Bookmark</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/x-icon">
    <script src="{{ asset('js/theme.js') }}"></script>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">Cooking Recipes</div>
            <nav>
                <a href="{{ route('home') }}">Home</a>
                <a href="/search-recipe">Pencarian Resep</a>
                <a href="/bookmark" class="active">Bookmark</a>
                <a href="/logout">Logout</a>
                <button id="theme-toggle" aria-label="Toggle theme">
                    <span class="icon-sun" style="display: none;">☀️</span>
                    <span class="icon-moon">🌙</span>
                </button>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1 class="title">Resep yang Ditandai</h1>

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div id="recipe-list">
            @forelse ($bookmarks as $recipe)
                <div class="recipe-card">
                    @if (!empty($recipe->image_url))
                        <img src="{{ asset('images/' . $recipe->image_url) }}" alt="Gambar {{ $recipe->title }}" class="recipe-image">
                    @else
                        <p>No image available</p>
                    @endif
                    <h2>
                        <a href="/detail-recipe/{{ $recipe->id }}">{{ $recipe->title }}</a>
                    </h2>
                    <p>{!! nl2br(e($recipe->description)) !!}</p>
                    <form action="{{ route('bookmark.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                        <button type="submit" class="btn btn-delete">Hapus dari Bookmark</button>
                    </form>
                </div>
            @empty
                <p>Tidak ada resep yang ditandai.</p>
            @endforelse
        </div>
    </div>
    
    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const iconSun = document.querySelector('.icon-sun');
        const iconMoon = document.querySelector('.icon-moon');

        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-theme');
            iconSun.style.display = iconSun.style.display === 'none' ? '' : 'none';
            iconMoon.style.display = iconMoon.style.display === 'none' ? '' : 'none';
        });
    </script>
</body>
</html>
