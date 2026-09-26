<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title ?? 'Detail Resep' }} - Cooking Recipes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/x-icon">
    <script src="{{ asset('js/theme.js') }}" defer></script>
</head>
<body>
    <header>
        <div class="navbar">
            <a href="{{ route('home') }}" class="logo">
                <span class="logo-icon">🍳</span>
                <span class="logo-text">Cooking Recipes</span>
            </a>

            <button class="nav-toggle" id="nav-toggle" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="nav-menu" id="nav-menu">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('search-recipe') }}" class="nav-link">Pencarian Resep</a>
                <a href="{{ route('bookmark.index') }}" class="nav-link">Bookmark</a>
                <a href="/" class="nav-link nav-link-logout">Logout</a>
                <button id="theme-toggle" class="theme-toggle" aria-label="Toggle theme">
                    <span class="icon-sun">☀️</span>
                    <span class="icon-moon">🌙</span>
                </button>
            </nav>
        </div>
    </header>

    <main class="container">
        <nav class="breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="breadcrumb-sep">/</span>
            <span class="breadcrumb-current">{{ $recipe->title ?? 'Detail Resep' }}</span>
        </nav>

        @if ($recipe)
            <article class="recipe-detail">
                <header class="recipe-detail-header">
                    <div class="recipe-detail-title-wrap">
                        <span class="recipe-detail-badge">🍽️ Resep</span>
                        <h1 class="recipe-detail-title">{{ $recipe->title }}</h1>
                    </div>

                    <div class="recipe-detail-actions">
                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus resep ini?')">Hapus</button>
                        </form>
                        <form action="{{ route('bookmark.add') }}" method="POST" class="inline-form">
                            @csrf
                            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                            <button type="submit" class="btn btn-bookmark">🔖 Bookmark</button>
                        </form>
                    </div>
                </header>

                @if ($recipe->image_url)
                    <div class="recipe-detail-hero">
                        <img src="{{ asset($recipe->image_url) }}" alt="{{ $recipe->title }}">
                    </div>
                @else
                    <div class="recipe-detail-hero recipe-detail-hero-placeholder">
                        <span>🍳</span>
                        <small>Belum ada gambar</small>
                    </div>
                @endif

                <div class="recipe-detail-grid">
                    <section class="recipe-detail-section">
                        <div class="section-heading">
                            <span class="section-icon">📝</span>
                            <h2>Deskripsi</h2>
                        </div>
                        <div class="section-content">
                            {!! nl2br(e($recipe->description)) !!}
                        </div>
                    </section>

                    <section class="recipe-detail-section">
                        <div class="section-heading">
                            <span class="section-icon">🥕</span>
                            <h2>Bahan-bahan</h2>
                        </div>
                        <div class="section-content">
                            {!! nl2br(e($recipe->ingredients)) !!}
                        </div>
                    </section>

                    <section class="recipe-detail-section">
                        <div class="section-heading">
                            <span class="section-icon">👨‍🍳</span>
                            <h2>Instruksi</h2>
                        </div>
                        <div class="section-content">
                            {!! nl2br(e($recipe->instructions)) !!}
                        </div>
                    </section>
                </div>

                <div class="recipe-detail-footer">
                    <a href="{{ route('home') }}" class="btn-back">
                        <span>←</span> Kembali ke Daftar Resep
                    </a>
                </div>
            </article>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">🔍</div>
                <h3>Resep tidak ditemukan</h3>
                <p>Resep yang kamu cari tidak tersedia atau sudah dihapus.</p>
                <a href="{{ route('home') }}" class="btn-add">Kembali ke Home</a>
            </div>
        @endif
    </main>

    <script src="{{ asset('js/nav.js') }}"></script>
</body>
</html>