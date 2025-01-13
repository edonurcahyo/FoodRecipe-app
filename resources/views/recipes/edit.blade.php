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

    <!-- @extends('layouts.app') -->

    <!-- @section('content') -->
    <div class="container">
        <h1>Edit Recipe</h1>

        <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $recipe->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" required>{{ $recipe->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="ingredients">Ingredients</label>
                <textarea id="ingredients" name="ingredients" class="form-control" required>{{ $recipe->ingredients }}</textarea>
            </div>

            <div class="form-group">
                <label for="instructions">Instructions</label>
                <textarea id="instructions" name="instructions" class="form-control" required>{{ $recipe->instructions }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">New Image</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            @if ($recipe->image_url)
            <div class="form-group">
                <p>Current Image:</p>
                <img src="{{ asset('storage/' . $recipe->image_url) }}" alt="Recipe Image" class="img-thumbnail" style="max-width: 200px;">
            </div>
            @endif

            <button type="submit" class="btn btn-primary">Update Recipe</button>
        </form>
    </div>
    @endsection

</body>
</html>
