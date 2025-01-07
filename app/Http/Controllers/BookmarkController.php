<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;
use App\Models\Recipe;

class BookmarkController extends Controller
{
    public function add(Request $request)
    {
        $userId = Auth::id();
        $recipeId = $request->input('recipe_id');

        if (!$recipeId) {
            return redirect()->route('bookmark.index')->with('message', 'ID Resep tidak valid.');
        }

        // Periksa apakah sudah di-bookmark
        $exists = Bookmark::where('user_id', $userId)->where('recipe_id', $recipeId)->exists();

        if (!$exists) {
            Bookmark::create([
                'user_id' => $userId,
                'recipe_id' => $recipeId,
            ]);
            return redirect()->route('bookmark.index')->with('message', 'Resep berhasil ditambahkan ke bookmark!');
        }

        return redirect()->route('bookmark.index')->with('message', 'Resep sudah ada di bookmark.');
    }

    public function index()
    {
        $userId = Auth::id();
        $bookmarks = Recipe::whereHas('bookmarks', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return view('bookmark.index', compact('bookmarks'));
    }

    public function remove(Request $request)
    {
        $userId = Auth::id();
        $recipeId = $request->input('recipe_id');

        Bookmark::where('user_id', $userId)->where('recipe_id', $recipeId)->delete();

        return redirect()->route('bookmark.index')->with('message', 'Resep berhasil dihapus dari bookmark.');
    }    
}
