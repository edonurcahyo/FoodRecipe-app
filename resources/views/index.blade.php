<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooking Recipes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="shortcut icon" href="{{ asset('image/icon.png') }}" type="image/x-icon">
</head>
<body>
    <header>
        <div class="navbar">
            <a href="/" class="logo">
                <span class="logo-icon">🍳</span>
                <span class="logo-text">Cooking Recipes</span>
            </a>

            <button class="nav-toggle" id="nav-toggle" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="nav-menu" id="nav-menu">
                <a href="/" class="nav-link active">Home</a>
                <!-- <a href="/categories" class="nav-link">Categories</a> -->
                <a href="/login" class="nav-link">Login</a>
                <a href="/register" class="nav-link nav-link-cta">Register</a>
                <button id="theme-toggle" class="theme-toggle" aria-label="Toggle theme">
                    <span class="icon-sun">☀️</span>
                    <span class="icon-moon">🌙</span>
                </button>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1 class="hero-title">Welcome to Cooking Recipes</h1>
                <p class="hero-subtitle">Your go-to place for delicious recipes!</p>
                <div class="hero-actions">
                    <a href="#featured" class="btn btn-primary">Explore Recipes</a>
                    <a href="/register" class="btn btn-secondary">Get Started</a>
                </div>
            </div>
        </section>

        <section class="featured-recipes" id="featured">
            <div class="section-header">
                <h2>Featured Recipes</h2>
                <p class="section-subtitle">Hand-picked recipes just for you</p>
            </div>

            <div class="recipe-cards">
                @forelse ($recipes as $recipe)
                    <article class="recipe-card">
                        <div class="recipe-card-image">
                            <img src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" loading="lazy">
                        </div>
                        <div class="recipe-card-body">
                            <h3><a href="/detail-recipe/{{ $recipe->id }}">{{ $recipe->title }}</a></h3>
                            <p class="description">{{ \Illuminate\Support\Str::limit($recipe->description, 100) }}</p>
                            <a href="/detail-recipe/{{ $recipe->id }}" class="recipe-card-link">
                                View Recipe →
                            </a>
                        </div>
                    </article>
                @empty
                    <p class="empty-state">No recipes available yet.</p>
                @endforelse
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <span class="logo-icon">🍳</span>
                <span>Cooking Recipes</span>
            </div>
            <p class="footer-copy">&copy; {{ date('Y') }} Cooking Recipes. All rights reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('js/theme.js') }}"></script>
    <script src="{{ asset('js/nav.js') }}"></script>
</body>
</html>