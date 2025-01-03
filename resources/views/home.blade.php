<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Home</title>
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
                <a href="{{ route('home') }}" class="active">Home</a>
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
        <h1>Daftar Resep</h1>
        <div class="add-recipe-btn">
            <a href="/add-recipe" class="btn-add">Tambah Resep Baru</a>
        </div>
        <div id="recipe-list">
            @foreach ($recipes as $recipe)
                <div class="recipe-card">
                    @if (!empty($recipe->image_url))
                        <img src="{{ asset('images/' . $recipe->image_url) }}" alt="{{ $recipe->title }}" class="recipe-image">
                    @else
                        <p>No image available</p>
                    @endif
                    <h2>
                        <a href="/detail-recipe/{{ $recipe->id }}">{{ $recipe->title }}</a>
                    </h2>
                    <p>{!! nl2br(e($recipe->description)) !!}</p>

                    <!-- Tombol Edit -->
                    <!-- <a href="/edit-recipe/{{ $recipe->id }}" class="btn btn-edit" style="display: inline-block;">Edit</a> -->
                    <form action="/edit-recipe/{{ $recipe->id }}" method="POST" style="display: inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-edit">Edit</button>
                    </form>

                    <!-- Tombol Hapus -->
                    <form action="/delete-recipe/{{ $recipe->id }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus resep ini?')">Hapus</button>
                    </form>

                    <!-- Tombol Tambah ke Bookmark -->
                    <form action="/bookmark/add" method="POST" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                        <button type="submit" class="btn btn-bookmark">Tambahkan ke Bookmark</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <script src="{{ asset('js/theme.js') }}"></script>
</body>
</html>
