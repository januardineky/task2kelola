<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});


Route::post('/auth', [AuthController::class, 'auth']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'createuser']);


Route::middleware(['state'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/index', [AdminController::class, 'index']);
        Route::get('/get-user-count', [AdminController::class, 'count']);
        Route::get('/users', [AdminController::class, 'users']);
        Route::get('/users/data', [AdminController::class, 'getUsers']);
        Route::post('/users/store', [AdminController::class, 'store']);
        Route::get('/users/{id}/edit', [AdminController::class, 'edit']);
        Route::put('/users/update/{id}', [AdminController::class, 'update']);
        Route::delete('/users/delete/{id}', [AdminController::class, 'destroy']);
    });


    Route::prefix('user')->group(function () {
        Route::get('/home', [UserController::class, 'home']);
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
