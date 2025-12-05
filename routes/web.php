<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/produk', function () {
    return view('product');
})->name('product');

Route::get('/supplier', function () {
    return view('supplier');
})->name('supplier');

Route::get('/cara_kerja', function () {
    return view('cara_kerja');
})->name('cara_kerja');

Route::get('/kontak', function () {
    return view('kontak'); 
})->name('kontak');

// Auth routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin (Super Admin) area - protected
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    // Dashboard
    Route::get('/super-admin', [SuperAdminController::class, 'index'])->name('admin.dashboard');

    // Produk
    Route::get('/super-admin/produk', [ProductController::class, 'index'])->name('admin.products');
    Route::post('/super-admin/produk', [ProductController::class, 'store'])->name('admin.products.store');

    // Kategori
    Route::get('/super-admin/kategori', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/super-admin/kategori', [CategoryController::class, 'store'])->name('admin.categories.store');

    // Pengguna
    Route::get('/super-admin/pengguna', function () {
        return view('admin.users');
    })->name('admin.users');

    // Transaksi
    Route::get('/super-admin/transaksi', function () {
        return view('admin.transactions');
    })->name('admin.transactions');

    // Supplier
    Route::get('/super-admin/supplier', function () {
        return view('admin.suppliers');
    })->name('admin.suppliers');

    // Dropshipper
    Route::get('/super-admin/dropshipper', function () {
        return view('admin.dropshippers');
    })->name('admin.dropshippers');
});
