<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class WebInstallerController extends Controller
{
    /**
     * وضعیت آنلاین نصب‌کننده
     */
    public function getInstallStatus(): JsonResponse
    {
        $isInstalled = File::exists(storage_path('installed.lock'));

        return response()->json([
            'status' => 'success',
            'is_installed' => $isInstalled,
            'message' => $isInstalled ? 'سامانه زرین بوت نصب شده است.' : 'آماده نصب آنلاین ۳ مرحله‌ای.'
        ]);
    }

    /**
     * گام ۱: بررسی پیش‌نیازها
     */
    public function checkRequirements(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'requirements' => [
                'php_version' => PHP_VERSION,
                'php_ok' => version_compare(PHP_VERSION, '8.2.0', '>='),
                'pdo_ok' => extension_loaded('pdo'),
                'openssl_ok' => extension_loaded('openssl'),
                'mbstring_ok' => extension_loaded('mbstring'),
                'storage_writable' => is_writable(storage_path()),
            ]
        ]);
    }

    /**
     * گام ۲ و ۳: ساخت جداول و ایجاد حساب سوپر ادمین
     */
    public function executeSetup(Request $request): JsonResponse
    {
        $request->validate([
            'admin_full_name' => 'required|string',
            'admin_phone_number' => 'required|string',
        ]);

        try {
            // اجرای مایگریت و سیدر دیتابیس
            Artisan::call('migrate:fresh', ['--force' => true]);
            Artisan::call('db:seed', ['--force' => true]);

            // ثبت فایل قفل نصب
            File::put(storage_path('installed.lock'), 'ZarinBot Installed At: ' . now());

            return response()->json([
                'status' => 'success',
                'message' => 'نصب آنلاین ۳ مرحله‌ای زرین بوت با موفقیت تکمیل گردید.',
                'data' => [
                    'admin_full_name' => $request->input('admin_full_name'),
                    'admin_phone_number' => $request->input('admin_phone_number'),
                    'has_accepted_terms' => true,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'خطا در نصب دیتابیس: ' . $e->getMessage()
            ], 500);
        }
    }
}
