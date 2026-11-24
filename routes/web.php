<?php

use App\Http\Controllers\Admin\AuthController;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Halaman publik (sementara)
Route::get('/', fn () => Inertia::render('Home', ['nama' => 'Dapur Ibu']));

// Admin
Route::prefix('admin')->group(function () {

    // Hanya untuk yang belum login
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'create'])->name('login');
        Route::post('login', [AuthController::class, 'store']);
    });

    // Hanya untuk yang sudah login
    Route::middleware('auth')->group(function () {
        Route::get('/', fn () => Inertia::render('Admin/Dashboard', [
            'totalMenus' => Menu::count(),
            'totalCategories' => Category::count(),
        ]))->name('admin.dashboard');

        Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
    });
});