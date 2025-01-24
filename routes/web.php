<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

// Rute untuk autentikasi
Route::post('/auth', [AuthController::class, 'auth']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'createuser']);

// Rute dengan middleware "state"
Route::middleware(['state'])->group(function () {

    // Rute untuk admin dengan prefix 'admin'
    Route::prefix('admin')->group(function () {
        Route::get('/users', [AdminController::class, 'getUsers']);
        Route::get('/users/{id}/edit', [AdminController::class, 'edit']);
        Route::put('/users/update/{id}', [AdminController::class, 'update']);
        Route::get('/index', [AdminController::class, 'index']);
    });

    // Rute untuk user dengan prefix 'user'
    Route::prefix('user')->group(function () {
        Route::get('/home', [UserController::class, 'home']);
    });

    // Rute logout (berlaku untuk semua)
    Route::get('/logout', [AuthController::class, 'logout']);
});
