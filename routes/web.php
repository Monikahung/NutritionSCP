<?php

use App\Http\Controllers\Admin\AboutUsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\NutritionProductController;
use Illuminate\Support\Facades\Http;


Route::get('/test-api', function () {
    $res = Http::get('https://world.openfoodfacts.org/cgi/search.pl?search_terms=minuman&json=true&page_size=24');
    return $res->json();
});
Route::get('/', function () {
    return view('login');
});

Route::get('/admin', [HomeAdminController::class, 'index'])->name('dashboardadmin');

Route::get('/admin/aboutus', [AboutUsController::class, 'index'])->name('aboutus');
Route::get('/admin/produk', [NutritionProductController::class, 'index'])->name('products.index');
Route::get('/admin/produk/{code}', [NutritionProductController::class, 'show'])->name('products.show');