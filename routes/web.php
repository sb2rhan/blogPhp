<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


# call index method of HomeController class
Route::redirect('/', 'posts')
    ->name('index');

Route::resource('posts', PostController::class)
    ->except('index', 'show')
    ->middleware('auth');

Route::resource('posts', PostController::class)
    ->only('index', 'show');

Route::prefix('posts/{post}')
    ->middleware('auth')
    ->group(function() { # comments routes are linked to post
        Route::resource('comments', CommentController::class)
            ->only('store');
    });

Route::resource('comments', CommentController::class)
    ->middleware('auth')
    ->only('destroy');

Route::resource('users', UserController::class)
    ->only('show');
