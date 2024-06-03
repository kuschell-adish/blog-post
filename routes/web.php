<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(UserController::class)->group(function () {
    Route::get('/register', 'register');
    Route::post('/store', 'store'); 
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/process', 'process');
    Route::post('/logout', 'logout');
    Route::get('/view/profile', 'view');
    Route::put('/user/{id}', 'update');
});

Route::controller(BlogController::class)->group(function () {
    Route::get('/', 'index')->middleware('auth'); 
    Route::post('/add/blog', 'create');
    Route::get('/view/blogs', 'view');
    Route::get('/filtered/blogs', 'filter');
    Route::get('/blog/{blog}', 'show');
    Route::put('/blog/{blog}', 'update');
    Route::delete('/blog/{blog}', 'destroy');
});

Route::controller(CommentsController::class)->group(function () {
    Route::get('/add/comment', 'index')->name('comment'); 
    Route::post('/post/comment', 'create');
    Route::get('/comment/{comment}', 'show');
    Route::put('/comment/{comment}', 'update');
    Route::delete('/comment/{comment}', 'destroy');
});




