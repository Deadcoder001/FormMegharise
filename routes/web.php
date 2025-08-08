<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Auth\SuperAdminLoginController;
use App\Http\Controllers\Auth\SuperAdminRegisterController;

Route::get('/', function () {
    return view('welcome');
});

// Vendor form routes
Route::get('/vendor/create', [VendorController::class, 'create'])->name('vendor.create');
Route::post('/vendor', [VendorController::class, 'store'])->name('vendor.store');

// Super Admin Auth
Route::get('/superadmin/login', [SuperAdminLoginController::class, 'showLoginForm'])->name('superadmin.login');
Route::post('/superadmin/login', [SuperAdminLoginController::class, 'login']);
Route::post('/superadmin/logout', [SuperAdminLoginController::class, 'logout'])->name('superadmin.logout');

Route::get('/superadmin/register', [SuperAdminRegisterController::class, 'showRegisterForm'])->name('superadmin.register');
Route::post('/superadmin/register', [SuperAdminRegisterController::class, 'register']);