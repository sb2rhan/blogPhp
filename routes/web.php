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
    ->middleware(['auth', 'verified']);

Route::resource('posts', PostController::class)
    ->only('index', 'show');


Route::resource('categories', CategoryController::class)
    ->except('index', 'show')
    ->middleware(['auth', 'verified']);

Route::resource('categories', CategoryController::class)
    ->only('index');

Route::resource('categories.products', ProductController::class)
    ->except('index', 'show')
    ->middleware(['auth', 'verified'])
    ->shallow();

Route::resource('categories.products', ProductController::class)
    ->only('index', 'show')
    ->shallow();

Route::delete('products/{product}/image', [ProductController::class, 'deleteImage'])
    ->middleware(['auth', 'verified'])
    ->name('products.deleteImage');
