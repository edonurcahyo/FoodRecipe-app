@extends('layouts.app')

@section('title', 'Bookmark - Cooking Recipes')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/bookmark.css') }}">
@endpush

@section('content')
    {{-- ===== Breadcrumb ===== --}}
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-current">Bookmark</span>
    </nav>

    {{-- ===== Page Header ===== --}}
    <header class="page-header">
        <div>
            <h1 class="page-title">
                <span class="title-icon">🔖</span>
                Resep yang Ditandai
                @if ($bookmarks->isNotEmpty())
                    <span class="section-count">{{ $bookmarks->count() }}</span>
                @endif
            </h1>
            <p class="page-subtitle">Koleksi resep favorit yang kamu simpan</p>
        </div>
        <a href="{{ route('home') }}" class="btn-back">← Kembali ke Home</a>
    </header>

    {{-- ===== Daftar Bookmark ===== --}}
    <div id="recipe-list">
        @forelse ($bookmarks as $recipe)
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

                    {{-- Badge bookmark di atas gambar --}}
                    <span class="bookmark-badge" title="Ditandai">🔖</span>
                </div>

                <div class="recipe-card-body">
                    <h3>
                        <a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a>
                    </h3>

                    @if (!empty($recipe->category))
                        <span class="recipe-category">🏷️ {{ $recipe->category }}</span>
                    @endif

                    <p class="recipe-description">
                        {!! nl2br(e(\Illuminate\Support\Str::limit($recipe->description, 120))) !!}
                    </p>

                    <div class="recipe-actions">
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-view">
                            👁️ Lihat Resep
                        </a>

                        <form action="{{ route('bookmark.remove') }}" method="POST" class="inline-form">
                            @csrf
                            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                            <button
                                type="submit"
                                class="btn btn-delete"
                                onclick="return confirm('Hapus "{{ $recipe->title }}" dari bookmark?')"
                            >
                                ✕ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="empty-state">
                <div class="empty-state-icon">🔖</div>
                <h3>Belum ada resep yang ditandai</h3>
                <p>Simpan resep favoritmu dengan menekan tombol bookmark di halaman resep.</p>
                <a href="{{ route('home') }}" class="btn-add">
                    <span class="btn-add-icon">+</span>
                    Jelajahi Resep
                </a>
            </div>
        @endforelse
    </div>

    {{-- ===== Toast Notification ===== --}}
    @if (session('message'))
        <div class="toast toast-success" id="toast" role="alert">
            <span class="toast-icon">✅</span>
            <span class="toast-message">{{ session('message') }}</span>
            <button type="button" class="toast-close" onclick="document.getElementById('toast').remove()">✕</button>
        </div>
    @endif

    @if (session('error'))
        <div class="toast toast-error" id="toast" role="alert">
            <span class="toast-icon">⚠️</span>
            <span class="toast-message">{{ session('error') }}</span>
            <button type="button" class="toast-close" onclick="document.getElementById('toast').remove()">✕</button>
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        // Auto-hilang setelah 4 detik
        (function () {
            const toast = document.getElementById('toast');
            if (!toast) return;
            setTimeout(function () {
                toast.classList.add('toast-hide');
                setTimeout(function () { toast.remove(); }, 400);
            }, 4000);
        })();
    </script>
@endpush