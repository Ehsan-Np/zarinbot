<?php

use App\Http\Controllers\DemoDashboardController;
use App\Http\Controllers\WebInstallerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DemoDashboardController::class, 'index']);
Route::get('/demo', [DemoDashboardController::class, 'index']);

// نصب‌کننده آنلاین ۴ مرحله‌ای وردپرسی
Route::get('/install', [WebInstallerController::class, 'showWizard']);

Route::get('/admin/settings', function () {
    return view('admin.settings');
});
