<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserFriendsController;
use \App\Http\Controllers\InvitationsController;
use App\Http\Controllers\ChannelController;
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
Route::put('/profile/{id}/edit', [ProfileController::class, 'edit']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/friends/{id}', [UserFriendsController::class, 'get']);
Route::post('/friends/{id}', [UserFriendsController::class, 'create']);
Route::delete('/friends/{id}/delete', [UserFriendsController::class, 'delete']);

Route::post('/invitations/{name}', [InvitationsController::class, 'sendInvitation']);
Route::get('/invitations', [InvitationsController::class, 'getInvitations']);
Route::get('/myInvitations', [InvitationsController::class, 'getMyInvitations']);
Route::put('/invitations/{id}', [InvitationsController::class, 'update']);
Route::delete('/invitations/{id}', [InvitationsController::class, 'delete']);
Route::delete('/myInvitations/{id}', [InvitationsController::class, 'deleteMyInvitation']);

Route::get('/channel', [ChannelController::class, 'index']);
Route::get('/channel/createForm', [ChannelController::class, 'createChannelForm']);
Route::get('/channel/{id}', [ChannelController::class, 'getChannel']);
Route::get('/messages', [ChannelController::class, 'messagesWithUser']);
Route::post('/messages', [ChannelController::class, 'newMessage']);
