<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Resep</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/add.css') }}">
    <link rel="shortcut icon" href="{{ asset('image/icon.png') }}" type="image/x-icon">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">Cooking Recipes</div>
            <nav>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('search-recipe') }}">Pencarian Resep</a>
                <a href="{{ route('bookmark.index') }}">Bookmark</a>
                <a href="/logout">Logout</a>
            </nav>
        </div>
    </header>
    <div class="form-container">
        <h1>Tambah Resep Baru</h1>

        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Judul Resep</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="ingredients">Bahan-bahan</label>
                <textarea id="ingredients" name="ingredients" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="instructions">Instruksi</label>
                <textarea id="instructions" name="instructions" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <button type="submit" class="btn-submit">Tambah Resep</button>
        </form>
    </div>
</body>
</html>
