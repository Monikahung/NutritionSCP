<?php

use App\Http\Controllers\Admin\AboutUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\NutritionProductController;
use App\Http\Controllers\Public\HomePublicController;

// Route homepublic menampilkan home public
Route::get('/', [HomePublicController::class, 'HomePublic'])->name('homepublic');

Route::get('/admin/api/products', [NutritionProductController::class, 'api']);
Route::get('/admin', [HomeAdminController::class, 'index'])->name('dashboardadmin');
Route::get('/admin/aboutus', [AboutUsController::class, 'index'])->name('aboutus');

Route::get('/admin/produk', [NutritionProductController::class, 'index'])->name('products.index');

Route::get('/admin/produk/{code}', [NutritionProductController::class, 'show'])->name('products.show');
