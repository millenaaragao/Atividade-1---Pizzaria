<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route to create a new user
Route::post('/cadastrar', [UserController::class, 'store']);

// Routes grouped under "/user"
Route::prefix('/user')->group(function (){
    Route::get('/', [UserController::class, 'index']);  // List users
    Route::get('/visualizar/{id}', [UserController::class, 'show']);  // Show user
    Route::put('/atualizar/{id}', [UserController::class, 'update']);  // Update user
    Route::delete('/deletar/{id}', [UserController::class, 'destroy']);  // Delete user
});
