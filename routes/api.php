<?php

use App\Http\Controllers\PhonebookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('signin', [UserController::class, 'signin']);
Route::post('signup', [UserController::class, 'signup']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('signout', [UserController::class, 'signout']);
    Route::post('phonebook/create', [PhonebookController::class, 'createRecord']);
    Route::put('phonebook/update', [PhonebookController::class, 'updateRecord']);
    Route::delete('phonebook/delete', [PhonebookController::class, 'deleteRecord']);
    Route::post('phonebook/export', [PhonebookController::class, 'exportReport']);
});
