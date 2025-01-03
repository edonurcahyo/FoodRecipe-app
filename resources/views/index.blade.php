<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooking Recipes</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="shortcut icon" href="{{ asset('image/icon.png') }}" type="image/x-icon">
    <script src="{{ asset('js/theme.js') }}"></script>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">Cooking Recipes</div>
            <nav>
                <a href="/">Home</a>
                <a href="/categories">Categories</a>
                <a href="/login">Login</a>
                <a href="/register">Register</a>
                <button id="theme-toggle" aria-label="Toggle theme">
                <span class="icon-sun" style="display: none;">☀️</span>
                <span class="icon-moon">🌙</span>
                </button>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <h1 class="hero-text">Welcome to Cooking Recipes</h1>
            <p class="hero-text">Your go-to place for delicious recipes!</p>
        </section>

        <section class="featured-recipes">
            <h2>Featured Recipes</h2>
            <div class="recipe-cards">
                @foreach ($recipes as $recipe)
                    <div class="recipe-card">
                        <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}">
                        <h3><a href="/recipe/{{ $recipe->id }}">{{ $recipe->title }}</a></h3>
                        <p class="description">{{ \Illuminate\Support\Str::limit($recipe->description, 100) }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Cooking Recipes. All rights reserved.</p>
    </footer>

    <script src="{{ asset('js/theme.js') }}"></script>
</body>
</html>
