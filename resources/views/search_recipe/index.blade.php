@extends('layouts.app')

@section('title', 'Pencarian Resep - Cooking Recipes')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

@section('content')
    {{-- ===== Hero Search ===== --}}
    <section class="search-hero">
        <div class="search-hero-content">
            <span class="search-hero-badge">🔍 Pencarian</span>
            <h1 class="search-hero-title">Cari Resep Favoritmu</h1>
            <p class="search-hero-subtitle">
                Temukan inspirasi masakan dari koleksi resep kami
            </p>

            <form method="GET" action="{{ route('search-recipe') }}" class="search-form" role="search">
                <div class="search-input-wrap">
                    <span class="search-icon">🔍</span>
                    <input
                        type="text"
                        name="search"
                        placeholder="Cari resep... (misal: nasi goreng, soto, rendang)"
                        value="{{ $searchTerm }}"
                        class="search-input"
                        autofocus
                        aria-label="Cari resep"
                    >
                    @if (!empty($searchTerm))
                        <a href="{{ route('search-recipe') }}" class="search-clear" aria-label="Bersihkan pencarian">✕</a>
                    @endif
                </div>
                <button type="submit" class="search-btn">
                    Cari
                </button>
            </form>
        </div>
    </section>

    {{-- ===== Hasil Pencarian ===== --}}
    @if (!empty($searchTerm))
        <section class="search-results">
            <header class="section-header">
                <div>
                    <h2 class="section-title">
                        Hasil Pencarian
                        <span class="section-count">{{ $recipes->count() }}</span>
                    </h2>
                    <p class="section-subtitle">
                        Menampilkan hasil untuk "<strong>{{ $searchTerm }}</strong>"
                    </p>
                </div>
                <a href="{{ route('search-recipe') }}" class="btn-back">← Reset Pencarian</a>
            </header>

            @if ($recipes->isNotEmpty())
                <div class="recipe-cards">
                    @foreach ($recipes as $recipe)
                        <article class="recipe-card">
                            <div class="recipe-card-image">
                                @if (!empty($recipe->image_url))
                                    <img src="{{ asset($recipe->image_url) }}" alt="{{ $recipe->title }}" loading="lazy">
                                @else
                                    <div class="recipe-image-placeholder">
                                        <span>🍳</span>
                                        <small>No image</small>
                                    </div>
                                @endif
                            </div>
                            <div class="recipe-card-body">
                                <h3>
                                    <a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a>
                                </h3>
                                <p class="recipe-description">
                                    {{ \Illuminate\Support\Str::limit($recipe->description, 100) }}
                                </p>
                                <a href="{{ route('recipes.show', $recipe->id) }}" class="recipe-card-link">
                                    Lihat Resep →
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">🔍</div>
                    <h3>Tidak ada resep yang ditemukan</h3>
                    <p>Coba gunakan kata kunci lain atau jelajahi rekomendasi di bawah.</p>
                    <a href="{{ route('search-recipe') }}" class="btn-add">Lihat Rekomendasi</a>
                </div>
            @endif
        </section>
    @endif

    {{-- ===== Rekomendasi (muncul kalau tidak ada pencarian) ===== --}}
    @if (empty($searchTerm))
        <section class="search-results">
            <header class="section-header">
                <div>
                    <h2 class="section-title">
                        Rekomendasi Resep
                        <span class="section-count">{{ $recommendations->count() }}</span>
                    </h2>
                    <p class="section-subtitle">Pilihan resep yang mungkin kamu suka</p>
                </div>
            </header>

            @if ($recommendations->isNotEmpty())
                <div class="recipe-cards">
                    @foreach ($recommendations as $recipe)
                        <article class="recipe-card">
                            <div class="recipe-card-image">
                                @if (!empty($recipe->image_url))
                                    <img src="{{ asset($recipe->image_url) }}" alt="{{ $recipe->title }}" loading="lazy">
                                @else
                                    <div class="recipe-image-placeholder">
                                        <span>🍳</span>
                                        <small>No image</small>
                                    </div>
                                @endif
                            </div>
                            <div class="recipe-card-body">
                                <h3>
                                    <a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a>
                                </h3>
                                <p class="recipe-description">
                                    {{ \Illuminate\Support\Str::limit($recipe->description, 100) }}
                                </p>
                                <a href="{{ route('recipes.show', $recipe->id) }}" class="recipe-card-link">
                                    Lihat Resep →
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">🍽️</div>
                    <h3>Belum ada resep</h3>
                    <p>Belum ada resep yang tersedia saat ini.</p>
                </div>
            @endif
        </section>
    @endif
@endsection