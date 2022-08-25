<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();


Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::resource('/posts', PostController::class)->except('index');
    Route::resource('/comments', CommentController::class)->except('index');
    Route::resource('/users', UserController::class)->except('index');
});
