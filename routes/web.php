<?php

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


# this route is protected by Authentication middleware
Route::get('secret', function () {
    echo 'Top secret INFO!';
})->middleware('auth');
