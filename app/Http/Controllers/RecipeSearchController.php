<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeSearchController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search', '');

        // Escape karakter khusus untuk menghindari XSS
        $searchTerm = htmlspecialchars($searchTerm);

        // Jika ada keyword pencarian, cari resep
        $recipes = [];
        if (!empty($searchTerm)) {
            $recipes = Recipe::where('title', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('ingredients', 'LIKE', '%' . $searchTerm . '%')
                ->get();
        }

        // Rekomendasi resep acak
        $recommendations = Recipe::inRandomOrder()->limit(3)->get();

        return view('search_recipe.index', [
            'searchTerm' => $searchTerm,
            'recipes' => $recipes,
            'recommendations' => $recommendations,
        ]);
    }
}
