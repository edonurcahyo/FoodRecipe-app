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
        <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data" class="recipe-form">
            @csrf
            <div class="form-group">
                <label for="title">Judul Resep</label>
                <input type="text" id="title" name="title" placeholder="Masukkan judul resep" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi Resep</label>
                <textarea id="description" name="description" placeholder="Masukkan deskripsi resep" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="ingredients">Bahan</label>
                <textarea id="ingredients" name="ingredients" placeholder="Masukkan bahan-bahan resep" required>{{ old('ingredients') }}</textarea>
            </div>

            <div class="form-group">
                <label for="instructions">Instruksi</label>
                <textarea id="instructions" name="instructions" placeholder="Masukkan instruksi langkah demi langkah" required>{{ old('instructions') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Pilih Gambar</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn-submit">Tambah Resep</button>
        </form>
    </div>
</body>
</html>
