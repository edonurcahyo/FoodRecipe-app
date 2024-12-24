<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = DB::table('recipes')->inRandomOrder()->limit(6)->get();
        return view('index', ['recipes' => $recipes]);
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'ingredients' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('recipes', 'public') : null;

        Recipe::create([
            'name' => $request->name,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'image' => $imagePath,
        ]);

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
    }
}