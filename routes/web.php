<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
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

Route::view('/', 'index')->name('index');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/posts', PostController::class);
    Route::get('/my-notes', [PostController::class, 'showPersonal'])->name('personal');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});
