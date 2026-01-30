<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;

// ------------------
// Admin Login Routes
// ------------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login_submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ------------------
// Protected Admin Routes
// ------------------
Route::middleware(['auth:admin', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('users')->name('users_')->group(function () {
        Route::get('/', [User\UserController::class, 'index'])->name('index');
        Route::post('/table', [User\UserController::class, 'table'])->name('table');
        Route::post('/create', [User\UserController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [User\UserController::class, 'edit'])->name('edit');
        Route::post('/update', [User\UserController::class, 'update'])->name('update');
        Route::get('/delete', [User\UserController::class, 'destroy'])->name('delete');
    });

    Route::prefix('blogs')->name('blogs_')->group(function () {
        Route::get('/', [Blog\BlogController::class, 'index'])->name('index');
        Route::post('/table', [Blog\BlogController::class, 'table'])->name('table');
        Route::post('/create', [Blog\BlogController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [Blog\BlogController::class, 'edit'])->name('edit');
        Route::post('/update', [Blog\BlogController::class, 'update'])->name('update');
        Route::get('/delete', [Blog\BlogController::class, 'destroy'])->name('delete');
    });
});
