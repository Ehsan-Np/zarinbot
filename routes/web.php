<?php

use App\Http\Controllers\DemoDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DemoDashboardController::class, 'index']);
Route::get('/demo', [DemoDashboardController::class, 'index']);

Route::get('/install', function () {
    return view('install');
});

Route::get('/admin/settings', function () {
    return view('admin.settings');
});
