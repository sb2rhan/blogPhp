<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

# call index method of HomeController class
Route::get('/', [HomeController::class, 'index'])
    ->name('index');

/*Route::get('posts', [PostController::class, 'index'])
    ->name('posts.index');

Route::get('posts/create', [PostController::class, 'create'])
    ->name('posts.create');

// READING DATA -> GET/HEAD
// CREATING DATA -> POST
// UPDATING DATA -> PUT/PATCH
// DELETING DATA -> DELETE

Route::post('posts', [PostController::class, 'store'])
    ->name('posts.store');

# {post} is id which will be checked in DB
Route::get('posts/{post}', [PostController::class, 'show'])
    ->name('posts.show');

Route::get('posts/{post}/edit', [PostController::class, 'edit'])
    ->name('posts.edit');

Route::put('posts/{post}', [PostController::class, 'update'])
    ->name('posts.update');

Route::delete('posts/{post}', [PostController::class, 'destroy'])
    ->name('posts.delete');*/

# Doing all of the above by 1 line
# It learns all functions from PostController and creates routes by them
Route::resource('posts', PostController::class);
