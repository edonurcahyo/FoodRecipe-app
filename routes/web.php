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
|
| Di sini Anda dapat mendaftarkan rute aplikasi Anda. Rute ini akan dimuat
| oleh RouteServiceProvider dalam grup yang berisi middleware "web".
|
*/

// Rute Halaman Utama
Route::get('/', [RecipeController::class, 'index'])->name('index');

// Rute Resep
Route::resource('recipes', RecipeController::class);
Route::get('/detail-recipe/{id}', [RecipeController::class, 'show'])->name('recipe.show');

// Rute Autentikasi
Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Rute Halaman Home
Route::get('/home', [RecipeController::class, 'home'])->middleware('auth')->name('home');

// Rute Bookmark (Dilindungi oleh Middleware `auth`)
Route::middleware(['auth'])->group(function () {
    Route::post('/bookmark/add', [BookmarkController::class, 'add'])->name('bookmark.add');
    Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark.index');
    Route::post('/bookmark/remove', [BookmarkController::class, 'remove'])->name('bookmark.remove');
});

// Rute Pencarian Resep
Route::get('/search-recipe', [RecipeSearchController::class, 'index'])->name('search-recipe');


Route::get('/add-recipe', [RecipeController::class, 'create'])->name('recipes.create');
Route::post('/add-recipe', [RecipeController::class, 'store'])->name('recipes.store');

Route::put('/recipes/{id}', [RecipeController::class, 'update'])->name('recipes.update');
