<?php

use App\Http\Controllers\HomeController;
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

# slash is not necessary here
Route::get('form', [HomeController::class, 'form'])
    ->name('form');

Route::post('form', [HomeController::class, 'handle'])
    ->name('form.handle');

/*# name? - can be null
Route::get('/hello/{name?}', function ($name = 'Guest') {
   return "Hello, {$name}!";
});*/

/*# only digit ids
Route::get('/posts/{id}', function ($id) {
    return "ID -> {$id}";
})->where('id', '[0-9]+');*/
