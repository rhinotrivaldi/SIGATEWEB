<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VehicleController;

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
    return view('welcome');
})->middleware('auth');

Route::middleware('only_guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authentication'])->name('authentication');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerProccess'])->name('registerProccess');
    Route::get('forgot-password', [AuthController::class, 'forgot'])->name('forgot');
});

Route::middleware('auth')->group(function () {
    Route::get('index', [UserController::class, 'index'])->middleware('only_user');
    Route::get('dashboard', [AdminController::class, 'index'])->middleware('only_admin')->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('vehicle', [VehicleController::class, 'index'])->name('vehicle');
Route::get('category', [CategoryController::class, 'index'])->name('category');