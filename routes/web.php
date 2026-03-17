<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\NutritionProductController;
use App\Http\Controllers\Public\HomePublicController;
use Illuminate\Support\Facades\Route;

Route::get('/test-api', function () {
    $res = Http::get('https://world.openfoodfacts.org/cgi/search.pl?search_terms=minuman&json=true&page_size=24');

    return $res->json();
});

// Route homepublic menampilkan home public
Route::get(
    '/',
    [HomePublicController::class,
        'HomePublic'])
    ->name('homepublic');

Route::get(
    '/admin',
    [HomeAdminController::class,
        'index'])
    ->name('dashboardadmin');

Route::get(
    '/admin/aboutus',
    [AboutUsController::class,
        'index'])
    ->name('aboutus');

Route::get(
    '/admin/produk',
    [NutritionProductController::class,
        'index'])
    ->name('products.index');

Route::get(
    '/admin/produk/{code}',
    [NutritionProductController::class,
        'show'])
    ->name('products.show');
