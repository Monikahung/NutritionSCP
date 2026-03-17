<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Admin\HomeAdminController;

Route::get('/', function () {
    return view('admin.home');
});

Route::get('/demo', [DemoController::class, 'index']);
Route::get('/admin', [HomeAdminController::class, 'index']);