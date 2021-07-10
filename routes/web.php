<?php

use App\Http\Controllers\CategoryController;
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


Route::resource('categories', CategoryController::class)
    ->except('index', 'show')
    ->middleware('auth');

Route::resource('categories', CategoryController::class)
    ->except('show')
    ->only('index');

Route::resource('categories.products', ProductController::class)
    ->except('index', 'show')
    ->middleware('auth')
    ->shallow();

Route::resource('categories.products', ProductController::class)
    ->only('index', 'show')
    ->shallow();
