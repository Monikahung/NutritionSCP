<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\NutritionProductController;

Route::get('/', function () {
    return view('login');
});

Route::get('/admin', [HomeAdminController::class, 'index'])->name('dashboardadmin');
Route::get('/admin/produk', [NutritionProductController::class, 'index'])->name('products.index');
Route::get('/admin/produk/{code}', [NutritionProductController::class, 'show'])->name('products.show');