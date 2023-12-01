<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::middleware(['auth'])->group(function () {

    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/compte', [PostController::class, 'compte'])->name('posts.compte');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');

    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/destroy/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/confirm-destroy/{post}', [PostController::class, 'destroyConfirmation'])->name('posts.confirm-destroy');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

    Route::get('/profile/avatar', [ProfileController::class, 'showAvatarForm'])->name('profile.avatar');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::get('/post/search', [PostController::class, 'search'])->name('post.search');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
    Route::delete('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('posts.unlike');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/{user}', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::post('/follow/{user}', [ProfileController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{user}', [ProfileController::class, 'unfollow'])->name('unfollow');

});

require __DIR__.'/auth.php';
