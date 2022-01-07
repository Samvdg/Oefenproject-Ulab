<?php

use App\Http\Controllers\RoutingController;
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

// Home route. Redirects to the topics index page with proper URI
Route::get('/', function(){ return redirect('/review/topics'); });

// Dynamic routing
Route::any('{x}', [RoutingController::class, 'dynamic'])->where('x', '.*');
