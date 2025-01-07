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
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [RecipeController::class, 'index']);
Route::resource('recipes', RecipeController::class);

Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register', [AuthController::class, 'register']);

Route::get('/', [RecipeController::class, 'index'])->name('index');

Route::get('/home', [RecipeController::class, 'home'])->middleware('auth')->name('home');
Route::get('/detail-recipe/{id}', [RecipeController::class, 'show'])->name('recipe.show');

Route::middleware(['auth'])->group(function () {
    Route::post('/bookmark/add', [BookmarkController::class, 'add'])->name('bookmark.add');
    Route::get('/bookmark', [BookmarkController::class, 'index'])->name('bookmark.index');
    Route::post('/bookmark/remove', [BookmarkController::class, 'remove'])->name('bookmark.remove');
});

Route::get('/search-recipe', [RecipeSearchController::class, 'index'])->name('search-recipe');

Route::get('/add-recipe', [RecipeController::class, 'create'])->name('recipes.create');
Route::post('/add-recipe', [RecipeController::class, 'store'])->name('recipes.store');

Route::delete('/recipes/{id}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

Route::get('/recipes/{id}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
Route::put('/recipes/{id}', [RecipeController::class, 'update'])->name('recipes.update');

