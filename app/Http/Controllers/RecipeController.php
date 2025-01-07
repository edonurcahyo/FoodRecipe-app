<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    // Menampilkan halaman index dengan resep acak
    public function index()
    {
        $recipes = Recipe::inRandomOrder()->limit(6)->get();
        return view('index', ['recipes' => $recipes]);
    }

    // Menampilkan halaman home dengan semua resep
    public function home()
    {
        $recipes = Recipe::all();
        return view('home', ['recipes' => $recipes]);
    }

    // Menampilkan detail resep berdasarkan ID
    public function show($id)
    {
        $recipe = Recipe::find($id);

        if (!$recipe) {
            return redirect()->route('home')->with('error', 'Resep tidak ditemukan.');
        }

        return view('recipes.detail', ['recipe' => $recipe]);
    }

    // Menampilkan formulir tambah resep
    public function create()
    {
        return view('recipes.create');
    }

    // Menyimpan resep baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'title.required' => 'Judul resep wajib diisi.',
            'description.required' => 'Deskripsi resep wajib diisi.',
            'ingredients.required' => 'Bahan resep wajib diisi.',
            'instructions.required' => 'Instruksi resep wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpg, jpeg, png, atau gif.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Upload gambar jika ada
        $imagePath = $this->uploadImage($request);

        // Simpan data ke database
        Recipe::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'ingredients' => $request->input('ingredients'),
            'instructions' => $request->input('instructions'),
            'image_url' => $imagePath,
        ]);

        return redirect()->route('home')->with('success', 'Resep berhasil ditambahkan!');
    }

    // Menampilkan formulir edit resep
    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.edit', compact('recipe'));
    }

    // Memperbarui data resep
    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);

        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            $this->deleteImage($recipe->image_url); // Hapus gambar lama
            $recipe->image_url = $this->uploadImage($request); // Simpan gambar baru
        }

        // Perbarui data resep
        $recipe->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'ingredients' => $request->input('ingredients'),
            'instructions' => $request->input('instructions'),
            'image_url' => $recipe->image_url,
        ]);

        return redirect()->route('recipes.show', $id)->with('success', 'Resep berhasil diperbarui!');
    }

    // Menghapus resep
    public function destroy($id)
    {
        $recipe = Recipe::find($id);

        if (!$recipe) {
            return redirect()->route('home')->with('error', 'Resep tidak ditemukan.');
        }

        // Hapus gambar jika ada
        $this->deleteImage($recipe->image_url);

        // Hapus data dari database
        $recipe->delete();

        return redirect()->route('home')->with('success', 'Resep berhasil dihapus.');
    }

    // Fungsi untuk mengunggah gambar
    private function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('uploads', 'public');
        }
        return null;
    }

    // Fungsi untuk menghapus gambar
    private function deleteImage($imagePath)
    {
        if ($imagePath && Storage::exists('public/' . $imagePath)) {
            Storage::delete('public/' . $imagePath);
        }
    }
}
