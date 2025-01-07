<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Resep</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="shortcut icon" href="{{ asset('image/icon.png') }}" type="image/x-icon">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">Cooking Recipes</div>
            <nav>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('search-recipe') }}" class="active">Pencarian Resep</a>
                <a href="{{ route('bookmark.index') }}">Bookmark</a>
                <a href="/logout">Logout</a>
            </nav>
        </div>
    </header>

    <div class="search-container">
        <h1>Cari Resep</h1>
        <form method="GET" action="{{ route('search-recipe') }}">
            <input type="text" name="search" placeholder="Cari resep..." value="{{ htmlspecialchars($searchTerm) }}" class="search-input">
            <button type="submit" class="search-btn">Cari</button>
        </form>
    </div>

    <div class="recipe-list">
        @if (!empty($searchTerm) && $recipes->isNotEmpty())
            <h2>Hasil Pencarian</h2>
            <div class="recipe-cards">
                @foreach ($recipes as $recipe)
                    <div class="recipe-card">
                        @if (!empty($recipe->image_url))
                            <img src="{{ asset('images/' . $recipe->image_url) }}" alt="Gambar {{ $recipe->title }}" class="recipe-image">
                        @endif
                        <h3><a href="/detail-recipe/{{ $recipe->id }}">{{ $recipe->title }}</a></h3>
                        <p>{{ Str::limit($recipe->description, 100) }}</p>
                    </div>
                @endforeach
            </div>
        @elseif (!empty($searchTerm))
            <p>Tidak ada resep yang ditemukan.</p>
        @endif
    </div>

    @if (empty($searchTerm))
        <div class="recommendations">
            <h2>Rekomendasi Resep</h2>
            <div class="recipe-cards">
                @foreach ($recommendations as $recipe)
                    <div class="recipe-card">
                        @if (!empty($recipe->image_url))
                            <img src="{{ asset('images/' . $recipe->image_url) }}" alt="Gambar {{ $recipe->title }}" class="recipe-image">
                        @endif
                        <h3><a href="/detail-recipe/{{ $recipe->id }}">{{ $recipe->title }}</a></h3>
                        <p>{{ Str::limit($recipe->description, 100) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</body>
</html>
