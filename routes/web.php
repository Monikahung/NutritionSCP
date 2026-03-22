<?php

use App\Http\Controllers\Admin\AboutUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\NutritionProductController;
use App\Http\Controllers\Public\HomePublicController;
use App\Http\Controllers\Public\LoginController;
use App\Http\Controllers\Public\RegisterController;
use App\Http\Controllers\Public\CalculatorController;

// Route homepublic for view home public page
Route::get('/', [HomePublicController::class, 'showHome'])->name('homepublic');

// Route login for view login page
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route login for handle login request
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.submit');

// Route register for view register page
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');

Route::get('/admin/api/products', [NutritionProductController::class, 'api']);
Route::get('/admin', [HomeAdminController::class, 'index'])->name('dashboardadmin');
Route::get('/admin/aboutus', [AboutUsController::class, 'index'])->name('aboutus');

Route::get('/admin/produk', [NutritionProductController::class, 'index'])->name('products.index');

Route::get('/admin/produk/{code}',[NutritionProductController::class,'show'])->name('products.show');
Route::get('/admin/produk/{code}', [NutritionProductController::class, 'show'])->name('products.show');

Route::get('/calculator', [CalculatorController::class, 'index']);
Route::post('/calculator', [CalculatorController::class, 'calculate'])->name('calculate');
Route::get('/search-products', [CalculatorController::class, 'search']);

