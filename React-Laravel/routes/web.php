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
    Route::get('/addpost', [PostController::class, 'create']);
    Route::post('/addpost', [PostController::class, 'store'])->name('addpost');
    Route::get('/editpost/{id}', [PostController::class, 'edit'])->name('editpost');
    Route::post('/updatepost/{id}', [PostController::class, 'update'])->name('updatepost');
    Route::delete('/posts', [PostController::class, 'destroy'])->name('deletepost');


    Route::get('/messages', [MessageController::class, 'index'])->name('message.show');
    Route::get('/addmessage', [MessageController::class, 'create']);
    Route::post('/addmessage/{id}', [MessageController::class, 'store'])->name('addmessage');
    Route::delete('/message', [MessageController::class, 'destroy'])->name('deletemessage');


    Route::get('/comment', [CommentController::class, 'index'])->name('comment.show');
    Route::get('/addcomment', [CommentController::class, 'create']);
    Route::post('/addcomment/{id}', [CommentController::class, 'store'])->name('addcomment');
    Route::get('/editcomment/{id}', [CommentController::class, 'edit'])->name('editcomment');
    Route::post('/updatecomment/{id}', [CommentController::class, 'update'])->name('updatecomment');
    Route::delete('/comment', [CommentController::class, 'destroy'])->name('deletecomment');



    Route::get('/like', [LikeController::class, 'index'])->name('like.show');
    Route::get('/like', [LikeController::class, 'edit'])->name('like.edit');
    Route::patch('/like', [LikeController::class, 'update'])->name('like.update');
    Route::delete('/like', [LikeController::class, 'destroy'])->name('like.destroy');




    Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/groups/{id}', [GroupController::class, 'show'])->name('groups.show');
    Route::get('/mygroups', [GroupController::class, 'mygroup'])->name('mygroup');  

    Route::get('/addgroups', [GroupController::class, 'create']);
    Route::post('/addgroups', [GroupController::class, 'store'])->name('addgroups');
    Route::get('/editgroups/{id}', [GroupController::class, 'edit'])->name('editgroups');
    Route::post('/updategroups/{id}', [GroupController::class, 'update'])->name('updategroups');
    Route::delete('/groups', [GroupController::class, 'destroy'])->name('deletegroups');






    Route::get('/file', [FileController::class, 'index'])->name('file.show');
    Route::get('/file', [FileController::class, 'edit'])->name('file.edit');
    Route::patch('/file', [FileController::class, 'update'])->name('file.update');
    Route::delete('/file', [FileController::class, 'destroy'])->name('file.destroy');


});

require __DIR__.'/auth.php';
