<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
   Route::get('/', [AuthController::class, 'dashboard']);
   Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');

    Route::resource('expenses', ExpenseController::class)->except(['show']);
    Route::resource('categories',CategoryController::class)->except('show');
    Route::resource('goals', GoalController::class)->except(['show']);
});
