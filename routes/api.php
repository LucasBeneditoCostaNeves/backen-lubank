<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController, AuthController,TransactionController};

Route::post('/users', [UserController::class, 'create']);
Route::get('/users', [UserController::class, 'capturing']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::middleware('jwt.verify')->group(function() {
    Route::post('/users/deposits', [UserController::class, 'deposit']);
    Route::post('/users/transactions', [TransactionController::class, 'create']);
    Route::get('/users/transactions', [TransactionController::class, 'capturing']);
});