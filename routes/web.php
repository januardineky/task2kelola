<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::post('/auth', [AuthController::class, 'auth']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'createuser']);

Route::middleware(['state'])->group(function () {
Route::get('/users', [AdminController::class, 'getUsers']);

Route::get('/users/{id}/edit', [AdminController::class, 'edit']);
Route::put('/users/update', [AdminController::class, 'update']);

Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/index', [AdminController::class, 'index']);

Route::get('/home', [UserController::class, 'home']);
});