<?php

use App\Http\Controllers\Controller;
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

Route::any('/{x}', [Controller::class, 'routing'])->where('x', '.*');
