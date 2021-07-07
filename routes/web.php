<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


# call index method of HomeController class
Route::redirect('/', 'posts')
    ->name('index');

Route::resource('posts', PostController::class)
    ->except('index', 'show')
    ->middleware('auth');

Route::resource('posts', PostController::class)
    ->only('index', 'show');

Route::delete('posts/{post}/image', [PostController::class, 'deleteImage'])
    ->middleware('auth')
    ->name('posts.deleteImage');


Route::prefix('posts/{post}')
    ->middleware(['auth', 'verified']) # check if email is verified
    ->group(function() { # comments routes are linked to post
        Route::resource('comments', CommentController::class)
            ->only('store');
    });

Route::resource('comments', CommentController::class)
    ->middleware(['auth', 'verified'])
    ->only('destroy');
