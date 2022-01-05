<?php

use App\Http\Controllers\review\CommentsController;
use App\Http\Controllers\review\PostsController;
use App\Http\Controllers\User\UserController;
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
Route::get('/review/comments', [CommentsController::class, 'index'])->name('comments');
Route::post('/review/comments', [CommentsController::class, 'post']);

Route::get('/review/posts', [PostsController::class, 'posts'])->name('posts');
Route::post('/review/posts', [PostsController::class, 'posts_post']);

Route::get('/user/login', [UserController::class, 'login'])->name('login');
Route::post('/user/login', [UserController::class, 'login_post']);

Route::get('/user/register', [UserController::class, 'register'])->name('register');
Route::post('/user/register', [UserController::class, 'register_post']);

Route::get('/user/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/user/profile', [UserController::class, 'profile_post']);



