<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
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

    <div class="container">
        <h1 class="title">Edit Resep</h1>
        <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Resep</label>
                <input type="text" id="title" name="title" value="{{ old('title', $recipe->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" required>{{ old('description', $recipe->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="ingredients">Bahan</label>
                <textarea id="ingredients" name="ingredients" required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
            </div>

            <div class="form-group">
                <label for="instructions">Instruksi</label>
                <textarea id="instructions" name="instructions" required>{{ old('instructions', $recipe->instructions) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Gambar Baru (opsional)</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>

            @if ($recipe->image_url)
                <div class="current-image">
                    <p>Gambar Saat Ini:</p>
                    <img src="{{ asset('storage/' . $recipe->image_url) }}" alt="Gambar Resep" class="recipe-image">
                </div>
            @endif

            <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
