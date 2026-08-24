<?php

use App\Http\Controllers\AntiCensorshipController;
use App\Http\Controllers\SettingsAndCMSController;
use App\Http\Controllers\WebInstallerController;
use App\Http\Controllers\WhatsAppGroupScraperController;
use Illuminate\Support\Facades\Route;

// ای‌پي‌آي‌های موتور آنتی‌فیلتر
Route::get('/antifilter/status', [AntiCensorshipController::class, 'getStatus']);
Route::get('/antifilter/doh', [AntiCensorshipController::class, 'testDohQuery']);
Route::get('/antifilter/tls-test', [AntiCensorshipController::class, 'testTlsFragmentation']);

// تنظیمات سوپر ادمین و پانویس کپی‌رایت HTML
Route::get('/settings', [SettingsAndCMSController::class, 'getSettings']);
Route::post('/settings/copyright', [SettingsAndCMSController::class, 'updateFooterCopyright']);

// استخراج اعضای گروه‌های واتساپ
Route::post('/whatsapp/scraper/store', [WhatsAppGroupScraperController::class, 'scrapeAndStore']);
Route::get('/whatsapp/scraper/master-directory', [WhatsAppGroupScraperController::class, 'getMasterDirectory']);

// نصب‌کننده آنلاین هاست
Route::get('/installer/status', [WebInstallerController::class, 'getInstallStatus']);
Route::post('/installer/execute', [WebInstallerController::class, 'executeSetup']);
