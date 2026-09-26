@extends('layouts.app')

@section('title', 'Tambah Resep Baru - Cooking Recipes')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-sep">/</span>
        <a href="{{ route('home') }}">Resep</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-current">Tambah Resep</span>
    </nav>

    <header class="form-page-header">
        <div>
            <h1 class="page-title">Tambah Resep Baru</h1>
            <p class="page-subtitle">Bagikan resep favoritmu ke semua orang 🍳</p>
        </div>
        <a href="{{ route('home') }}" class="btn-back">← Kembali</a>
    </header>

    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data" class="recipe-form" id="recipe-form">
        @csrf

        <div class="form-layout">
            {{-- ===== Kolom Kiri: Form ===== --}}
            <div class="form-main">

                {{-- Judul --}}
                <div class="form-group">
                    <label for="title" class="form-label">
                        <span class="label-icon">📝</span>
                        Judul Resep
                        <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}"
                        placeholder="Contoh: Nasi Goreng Spesial"
                        required
                    >
                    @error('title')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div class="form-group">
                    <label for="category" class="form-label">
                        <span class="label-icon">🏷️</span>
                        Kategori
                    </label>
                    <input
                        type="text"
                        id="category"
                        name="category"
                        class="form-control @error('category') is-invalid @enderror"
                        value="{{ old('category') }}"
                        placeholder="Contoh: Sarapan, Makan Siang, Dessert"
                        list="category-list"
                    >
                    <datalist id="category-list">
                        <option value="Sarapan">
                        <option value="Makan Siang">
                        <option value="Makan Malam">
                        <option value="Camilan">
                        <option value="Dessert">
                        <option value="Minuman">
                    </datalist>
                    @error('category')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label for="description" class="form-label">
                        <span class="label-icon">📄</span>
                        Deskripsi
                        <span class="required">*</span>
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        class="form-control @error('description') is-invalid @enderror"
                        rows="3"
                        placeholder="Ceritakan singkat tentang resep ini..."
                        required
                    >{{ old('description') }}</textarea>
                    <div class="form-hint">
                        <span class="char-count" data-for="description">0</span> karakter
                    </div>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bahan-bahan --}}
                <div class="form-group">
                    <label for="ingredients" class="form-label">
                        <span class="label-icon">🥕</span>
                        Bahan-bahan
                        <span class="required">*</span>
                    </label>
                    <textarea
                        id="ingredients"
                        name="ingredients"
                        class="form-control @error('ingredients') is-invalid @enderror"
                        rows="6"
                        placeholder="Tulis satu bahan per baris&#10;Contoh:&#10;2 butir telur&#10;1 sdm kecap manis&#10;..."
                        required
                    >{{ old('ingredients') }}</textarea>
                    <div class="form-hint">
                        <span class="char-count" data-for="ingredients">0</span> karakter
                    </div>
                    @error('ingredients')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Instruksi --}}
                <div class="form-group">
                    <label for="instructions" class="form-label">
                        <span class="label-icon">👨‍🍳</span>
                        Instruksi
                        <span class="required">*</span>
                    </label>
                    <textarea
                        id="instructions"
                        name="instructions"
                        class="form-control @error('instructions') is-invalid @enderror"
                        rows="8"
                        placeholder="Tulis langkah-langkah memasak&#10;Contoh:&#10;1. Panaskan minyak...&#10;2. Tumis bawang..."
                        required
                    >{{ old('instructions') }}</textarea>
                    <div class="form-hint">
                        <span class="char-count" data-for="instructions">0</span> karakter
                    </div>
                    @error('instructions')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Aksi --}}
                <div class="form-actions">
                    <a href="{{ route('home') }}" class="btn btn-cancel">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        💾 Simpan Resep
                    </button>
                </div>
            </div>

            {{-- ===== Kolom Kanan: Upload & Preview ===== --}}
            <aside class="form-side">
                <div class="upload-card">
                    <h3 class="upload-title">
                        <span class="label-icon">🖼️</span>
                        Gambar Resep
                    </h3>

                    <label for="image" class="upload-dropzone" id="upload-dropzone">
                        <div class="upload-placeholder" id="upload-placeholder">
                            <span class="upload-icon">📸</span>
                            <p class="upload-text"><strong>Klik untuk upload</strong></p>
                            <p class="upload-subtext">atau drag & drop gambar ke sini</p>
                            <p class="upload-meta">PNG, JPG, JPEG · Maks 2MB</p>
                        </div>
                        <img id="upload-preview" class="upload-preview" style="display:none;" alt="Preview">
                    </label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        class="upload-input @error('image') is-invalid @enderror"
                    >

                    <button type="button" class="btn-remove-image" id="btn-remove-image" style="display:none;">
                        ✕ Hapus Gambar
                    </button>

                    @error('image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="tips-card">
                    <h4 class="tips-title">💡 Tips</h4>
                    <ul class="tips-list">
                        <li>Gunakan foto dengan pencahayaan yang terang</li>
                        <li>Rasio ideal 16:9 atau 4:3</li>
                        <li>Ukuran file maksimal 2MB</li>
                        <li>Format: JPG, PNG, atau JPEG</li>
                    </ul>
                </div>
            </aside>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('js/form.js') }}"></script>
@endpush