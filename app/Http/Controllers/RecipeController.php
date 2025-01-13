<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    // Menampilkan halaman index dengan resep acak
    public function index()
    {
        $recipes = Recipe::inRandomOrder()->limit(6)->get();
        return view('index', compact('recipes'));
    }

    // Menampilkan halaman home dengan semua resep
    public function home()
    {
        $recipes = Recipe::all();
        return view('home', compact('recipes'));
    }

    // Menampilkan detail resep berdasarkan ID
    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.detail', compact('recipe'));
    }

    // Menampilkan formulir tambah resep
    public function create()
    {
        return view('recipes.create');
    }

    // Menyimpan resep baru ke database
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $validatedData['image_url'] = 'uploads/' . $imageName;
        } else {
            $validatedData['image_url'] = null;
        }

        // Simpan data ke database
        Recipe::create($validatedData);

        return redirect()->route('recipes.index')->with('success', 'Resep berhasil ditambahkan!');
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            if ($recipe->image_url && file_exists(public_path($recipe->image_url))) {
                unlink(public_path($recipe->image_url));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $validatedData['image_url'] = 'uploads/' . $imageName;
        } else {
            $validatedData['image_url'] = $recipe->image_url;
        }

        // Perbarui data resep
        $recipe->update($validatedData);

        return redirect()->route('recipes.show', $recipe->id)->with('success', 'Resep berhasil diperbarui!');
    }

    // Menghapus resep
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);

        // Hapus gambar jika ada
        if ($recipe->image_url && file_exists(public_path($recipe->image_url))) {
            unlink(public_path($recipe->image_url));
        }

        $recipe->delete();

        return redirect()->route('home')->with('success', 'Resep berhasil dihapus!');
    }
}
