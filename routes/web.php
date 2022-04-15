<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserFriendsController;
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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/profile/{id}', [ProfileController::class, 'get'] );
Route::get('/profile/{id}/edit/form', [ProfileController::class, 'editForm']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/friends/{id}', [UserFriendsController::class, 'get']);

Route::put('/profile/{id}/edit', [ProfileController::class, 'edit']);
