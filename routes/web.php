<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeRecipeController;
use App\Http\Controllers\PostBookmarkController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\RecipeController as AdminRecipeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [AboutController::class, 'index'])->name('about');

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post}/bookmark', [PostBookmarkController::class, 'toggleBookmark'])
        ->name('posts.bookmark');
    Route::get('/my-bookmarks', [PostBookmarkController::class, 'userBookmarks'])
        ->name('posts.bookmarks');

    Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
    Route::get('/recipes/{slug}', [RecipeController::class, 'show'])->name('recipes.show');
    Route::post('/recipes/{recipe}/like', [LikeRecipeController::class, 'toggleLike'])
        ->name('recipes.like');
    Route::get('/my-likes', [LikeRecipeController::class, 'userLikes'])
        ->name('recipes.likes');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('\App\Http\Middleware\AdminMiddleware')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('posts', AdminPostController::class);
        Route::resource('recipes', AdminRecipeController::class);
    });
});

require __DIR__.'/auth.php';
