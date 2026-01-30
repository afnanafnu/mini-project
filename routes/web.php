<?php

namespace App\Http\Controllers\Web;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [Home\HomeController::class, 'index'])->name('home');
Route::get('/about', [Home\HomeController::class, 'about'])->name('about');
Route::get('/contact', [Home\HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [Home\HomeController::class, 'sendContact'])->name('contact.send');
Route::post('/blogs/store', [Blogs\BlogsController::class, 'storeBlog'])->name('blogs.store');

// Add a redirect from /login to /admin/login

Route::get('/login', function () {
    return redirect()->route('admin_login');
})->name('login');

// Admin routes
Route::prefix('admin')->name('admin_')->group(function () {
    require __DIR__.'/admin.php';
});

// Public user routes
Route::prefix('user')->group(function () {
    Route::get('/register', [Auth\UserAuthController::class, 'showRegisterForm'])->name('user_register');
    Route::post('/register', [Auth\UserAuthController::class, 'register'])->name('user_register_submit');

    Route::get('/login', [Auth\UserAuthController::class, 'showLoginForm'])->name('user_login');
    Route::post('/login', [Auth\UserAuthController::class, 'login'])->name('user_login_submit');

    Route::post('/logout', [Auth\UserAuthController::class, 'logout'])->name('user_logout');

    // Protected routes
    Route::middleware('auth:web')->group(function () {
        Route::get('/dashboard', [Auth\UserAuthController::class, 'dashboard'])->name('user_dashboard');
    });
});