<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;

Route::match(['get', 'delete'], '/', function () {
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/{active?}/{country?}', [UsersController::class, 'getUsers']);

Route::put('/users/{id}', [UsersController::class, 'setUser']);

Route::delete('/users/{id}', [UsersController::class, 'deleteUser']);

Route::get('/transactions', [TransactionController::class, 'index'])->name('index');
