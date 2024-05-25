<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
   Route::get('/', [AuthController::class, 'dashboard']);
   Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
   Route::get('expenses/{userId}', [ExpenseController::class, 'index'])->name('expenses.index');
   Route::post('expenses', [ExpenseController::class, 'store'])->name('expenses.store');
   Route::delete('expenses/{id}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
});
