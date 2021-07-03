<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


# call index method of HomeController class
Route::redirect('/', 'posts')
    ->name('index');

Route::resource('posts', PostController::class)
    ->except('index', 'show')
    ->middleware('auth');

Route::resource('posts', PostController::class)
    ->only('index', 'show');


Route::resource('products', ProductController::class)
    ->except('index', 'show')
    ->middleware('auth');

Route::resource('products', ProductController::class)
    ->only('index', 'show');

