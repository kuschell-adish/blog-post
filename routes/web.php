<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

Route::redirect('/', '/sessions');

Route::resource('users', UserController::class);

Route::resource('sessions', SessionController::class);
Route::post('/sessions/logout', [SessionController::class, 'logout'])->name('sessions.logout');

Route::get('/forgot-password', [PasswordController::class, 'index'])->name('password.index');
Route::post('/forgot-password', [PasswordController::class, 'email'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordController::class, 'password'])->name('password.reset');
Route::post('/reset-password', [PasswordController::class, 'change'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('/blogs/filtered', [BlogController::class, 'filtered'])->name('blogs.filtered');
    Route::resource('blogs', BlogController::class);
    Route::resource('comments', CommentController::class);
});









