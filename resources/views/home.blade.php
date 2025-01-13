<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Home</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/x-icon">
    <script src="{{ asset('js/theme.js') }}" defer></script>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">Cooking Recipes</div>
            <nav>
                <a href="{{ route('home') }}" class="active">Home</a>
                <a href="{{ route('search-recipe') }}">Pencarian Resep</a>
                <a href="{{ route('bookmark.index') }}">Bookmark</a>
                <a href="/">Logout</a>
                <button id="theme-toggle" aria-label="Toggle theme">
                    <span class="icon-sun" style="display: none;">☀️</span>
                    <span class="icon-moon">🌙</span>
                </button>
            </nav>
        </div>
    </header>

    <main class="container">
        <h1>Daftar Resep</h1>
        <div class="add-recipe-btn">
            <a href="{{ route('recipes.create') }}" class="btn-add">Tambah Resep Baru</a>
        </div>

        <div id="recipe-list">
            @if ($recipes->isEmpty())
                <p>Tidak ada resep yang tersedia.</p>
            @else
                @foreach ($recipes as $recipe)
                    <div class="recipe-card">
                        @if (!empty($recipe->image_url))
                            <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" class="recipe-image">
                        @else
                            <p>No image available</p>
                        @endif
                        <h2>
                            <a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a>
                        </h2>
                        <p>{!! nl2br(e($recipe->description)) !!}</p>
                        
                        <!-- Tombol Edit -->
                        <form action="{{ route('recipes.edit', $recipe->id) }}" method="GET" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-edit">Edit</button>
                        </form>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus resep ini?')">Hapus</button>
                        </form>

                        <!-- Tombol Tambah ke Bookmark -->
                        <form action="{{ route('bookmark.add') }}" method="POST" style="display: inline-block;">
                            @csrf
                            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                            <button type="submit" class="btn btn-bookmark">Tambahkan ke Bookmark</button>
                        </form>
                    </div>
                @endforeach
            @endif
        </div>
    </main>
</body>
</html>
