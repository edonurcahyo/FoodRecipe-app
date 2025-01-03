<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Resep</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css')}}">
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
                <a href="/bookmark">Bookmark</a>
                <a href="/logout">Logout</a>
                <button id="theme-toggle" aria-label="Toggle theme">
                    <span class="icon-sun" style="display: none;">☀️</span>
                    <span class="icon-moon">🌙</span>
                </button>
            </nav>
        </div>
    </header>
    <div class="container">
        @if ($recipe)
            <h1>{{ $recipe->title }}</h1>
            @if ($recipe->image)
                <img src="{{ asset('uploads/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="recipe-image">
            @endif
            <div class="recipe-section">
                <p><strong>Deskripsi:</strong><br>{!! nl2br(e($recipe->description)) !!}</p>
            </div>
            <div class="recipe-section">
                <p><strong>Bahan:</strong><br>{!! nl2br(e($recipe->ingredients)) !!}</p>
            </div>
            <div class="recipe-section">
                <p><strong>Instruksi:</strong><br>{!! nl2br(e($recipe->instructions)) !!}</p>
            </div>
        @else
            <p>Resep tidak ditemukan.</p>
        @endif
        <a href="{{ route('home') }}" class="btn btn-add">Kembali ke Daftar Resep</a>
    </div>

    <script src="{{ asset('js/theme.js') }}"></script>
</body>
</html>
