<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('post.show');
    Route::get('/myposts', [PostController::class, 'myPosts'])->name('post.myposts');
    // Route::get('/post', [PostController::class, 'edit'])->name('post.edit');
    // Route::patch('/post', [PostController::class, 'update'])->name('post.update');
    // Route::delete('/post', [PostController::class, 'destroy'])->name('post.destroy');


    Route::get('/comment', [CommentController::class, 'index'])->name('comment.show');
    Route::get('/comment', [CommentController::class, 'edit'])->name('comment.edit');
    Route::patch('/comment', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/comment', [CommentController::class, 'destroy'])->name('comment.destroy');



    Route::get('/like', [LikeController::class, 'index'])->name('like.show');
    Route::get('/like', [LikeController::class, 'edit'])->name('like.edit');
    Route::patch('/like', [LikeController::class, 'update'])->name('like.update');
    Route::delete('/like', [LikeController::class, 'destroy'])->name('like.destroy');




    Route::get('/group', [GroupController::class, 'index'])->name('group.show');
    Route::get('/group', [GroupController::class, 'edit'])->name('group.edit');
    Route::patch('/group', [GroupController::class, 'update'])->name('group.update');
    Route::delete('/group', [GroupController::class, 'destroy'])->name('group.destroy');




    Route::get('/message', [MessageController::class, 'index'])->name('message.show');
    Route::get('/message', [MessageController::class, 'edit'])->name('message.edit');
    Route::patch('/message', [MessageController::class, 'update'])->name('message.update');
    Route::delete('/message', [MessageController::class, 'destroy'])->name('message.destroy');


    Route::get('/file', [FileController::class, 'index'])->name('file.show');
    Route::get('/file', [FileController::class, 'edit'])->name('file.edit');
    Route::patch('/file', [FileController::class, 'update'])->name('file.update');
    Route::delete('/file', [FileController::class, 'destroy'])->name('file.destroy');


});

require __DIR__.'/auth.php';
