<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\RecipeSearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===== Public Routes =====
Route::get('/', [RecipeController::class, 'index'])->name('index');

// ===== Auth Routes =====
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ===== Protected Routes (butuh login) =====
Route::middleware('auth')->group(function () {
    // Home
    Route::get('/home', [RecipeController::class, 'home'])->name('home');

    // Resep (CRUD)
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

    // Bookmark
    Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark.index');
    Route::post('/bookmark/add', [BookmarkController::class, 'add'])->name('bookmark.add');
    Route::post('/bookmark/remove', [BookmarkController::class, 'remove'])->name('bookmark.remove');
});

// ===== Public Recipe Detail (bisa diakses tanpa login) =====
Route::get('/detail-recipe/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

// ===== Search (public) =====
Route::get('/search-recipe', [RecipeSearchController::class, 'index'])->name('search-recipe');