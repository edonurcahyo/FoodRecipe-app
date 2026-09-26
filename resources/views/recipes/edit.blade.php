@extends('layouts.app')

@section('title', 'Edit Resep - ' . $recipe->title)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endpush

@section('content')
    <nav class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-sep">/</span>
        <a href="{{ route('recipes.show', $recipe->id) }}">{{ \Illuminate\Support\Str::limit($recipe->title, 30) }}</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-current">Edit</span>
    </nav>

    <header class="form-page-header">
        <div>
            <h1 class="page-title">Edit Resep</h1>
            <p class="page-subtitle">Perbarui detail resep <strong>{{ $recipe->title }}</strong></p>
        </div>
        <a href="{{ route('recipes.show', $recipe->id) }}" class="btn-back">← Kembali</a>
    </header>

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data" class="recipe-form" id="recipe-form">
        @csrf
        @method('PUT')

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
                        value="{{ old('title', $recipe->title) }}"
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
                        value="{{ old('category', $recipe->category) }}"
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
                        required
                    >{{ old('description', $recipe->description) }}</textarea>
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
                        required
                    >{{ old('ingredients', $recipe->ingredients) }}</textarea>
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
                        required
                    >{{ old('instructions', $recipe->instructions) }}</textarea>
                    <div class="form-hint">
                        <span class="char-count" data-for="instructions">0</span> karakter
                    </div>
                    @error('instructions')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Aksi --}}
                <div class="form-actions">
                    <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-cancel">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        💾 Update Resep
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
                        <div class="upload-placeholder" id="upload-placeholder" @if($recipe->image_url) style="display:none;" @endif>
                            <span class="upload-icon">📸</span>
                            <p class="upload-text"><strong>Klik untuk upload</strong></p>
                            <p class="upload-subtext">atau drag & drop gambar ke sini</p>
                            <p class="upload-meta">PNG, JPG, JPEG · Maks 2MB</p>
                        </div>
                        <img
                            id="upload-preview"
                            class="upload-preview"
                            src="{{ $recipe->image_url ? asset($recipe->image_url) : '' }}"
                            style="{{ $recipe->image_url ? '' : 'display:none;' }}"
                            alt="Preview"
                        >
                    </label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        class="upload-input @error('image') is-invalid @enderror"
                    >

                    @if ($recipe->image_url)
                        <label class="checkbox-remove">
                            <input type="checkbox" name="remove_image" value="1" id="remove_image">
                            <span>Hapus gambar saat ini</span>
                        </label>
                    @endif

                    <button type="button" class="btn-remove-image" id="btn-remove-image" style="display:none;">
                        ✕ Batalkan Gambar Baru
                    </button>

                    @error('image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="tips-card">
                    <h4 class="tips-title">💡 Tips</h4>
                    <ul class="tips-list">
                        <li>Biarkan kosong jika tidak ingin ganti gambar</li>
                        <li>Gunakan foto dengan pencahayaan yang terang</li>
                        <li>Rasio ideal 16:9 atau 4:3</li>
                        <li>Ukuran file maksimal 2MB</li>
                    </ul>
                </div>
            </aside>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('js/form.js') }}"></script>
@endpush