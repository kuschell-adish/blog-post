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

Route::get('/register', [UserController::class, 'register']);
Route::post('/store', [UserController::class, 'store']);

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/process', [UserController::class, 'process']);

Route::post('/logout', [UserController::class, 'logout']);

Route::get('/', [BlogController::class, 'index'])->middleware('auth'); 
Route::post('/add/blog', [BlogController::class, 'create']);

Route::get('/view/blogs', [BlogController::class, 'view']); 
Route::get('/filtered/blogs', [BlogController::class, 'filter']); 

Route::get('/blog/{blog}', [BlogController::class, 'show']); 
Route::put('/blog/{blog}', [BlogController::class, 'update']); 
Route::delete('/blog/{blog}', [BlogController::class, 'destroy']); 

Route::get('/view/profile', [UserController::class, 'view']); 

Route::get('/add/comment', [CommentsController::class, 'index'])->name('comment');
Route::post('/post/comment', [CommentsController::class, 'create'])->name('post.comment');

Route::get('/comment/{comment}', [CommentsController::class, 'show']); 
Route::put('/comment/{comment}', [CommentsController::class, 'update']); 
Route::delete('/comment/{comment}', [CommentsController::class, 'destroy']); 


