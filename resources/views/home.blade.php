@extends('layouts.app')

@section('title', 'Daftar Resep - Cooking Recipes')

@section('content')
    <div class="page-header">
        <div>
            <h1 class="page-title">Daftar Resep</h1>
            <p class="page-subtitle">Kelola dan jelajahi koleksi resep kamu</p>
        </div>
        <a href="{{ route('recipes.create') }}" class="btn-add">
            <span class="btn-add-icon">＋</span>
            Tambah Resep Baru
        </a>
    </div>

    <div id="recipe-list">
        @if ($recipes->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">🍽️</div>
                <h3>Belum ada resep</h3>
                <p>Mulai dengan menambahkan resep pertamamu!</p>
                <a href="{{ route('recipes.create') }}" class="btn-add">Tambah Resep</a>
            </div>
        @else
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
                        <h2>
                            <a href="{{ route('recipes.show', $recipe->id) }}">{{ $recipe->title }}</a>
                        </h2>
                        <p class="recipe-description">{!! nl2br(e(\Illuminate\Support\Str::limit($recipe->description, 120))) !!}</p>

                        <div class="recipe-actions">
                            <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-edit">
                                <span class="btn-icon">✏️</span>
                                <span>Edit</span>
                            </a>

                            <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn btn-delete"
                                    onclick="return confirm('Yakin ingin menghapus resep &quot;{{ $recipe->title }}&quot;?')"
                                >
                                    <span class="btn-icon">🗑️</span>
                                    <span>Hapus</span>
                                </button>
                            </form>

                            <form action="{{ route('bookmark.add') }}" method="POST" class="inline-form">
                                @csrf
                                <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                                <button type="submit" class="btn btn-bookmark">
                                    <span class="btn-icon">🔖</span>
                                    <span>Simpan</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        @endif
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