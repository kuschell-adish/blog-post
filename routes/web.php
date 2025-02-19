<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
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

Route::resource('users', UserController::class);

Route::post('/sessions/logout', [SessionController::class, 'logout'])->name('sessions.logout');
Route::resource('sessions', SessionController::class);

Route::middleware('auth')->group(function () {
    Route::get('/blogs/filtered', [BlogController::class, 'filtered'])->name('blogs.filtered');
    Route::resource('blogs', BlogController::class);
    Route::resource('comments', CommentController::class);
});





