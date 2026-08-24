<?php

namespace App\Http\Controllers;

use App\Models\GlobalSystemSetting;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class WebInstallerController extends Controller
{
    /**
     * نمایش صفحه نصب‌کننده آنلاین گرافیکی وردپرسی
     */
    public function showWizard()
    {
        if (File::exists(storage_path('installed.lock'))) {
            return redirect('/');
        }

        return view('install.wizard');
    }

    /**
     * گام ۱: چک کردن پیش‌نیازهای هاست
     */
    public function checkRequirements(): JsonResponse
    {
        $requirements = [
            'php_version' => PHP_VERSION,
            'php_ok' => version_compare(PHP_VERSION, '8.2.0', '>='),
            'pdo' => extension_loaded('pdo'),
            'openssl' => extension_loaded('openssl'),
            'mbstring' => extension_loaded('mbstring'),
            'curl' => extension_loaded('curl'),
            'storage_writable' => is_writable(storage_path()),
        ];

        $allOk = !in_array(false, $requirements, true);

        return response()->json([
            'status' => 'success',
            'all_ok' => $allOk,
            'requirements' => $requirements
        ]);
    }

    /**
     * گام ۲: تست زنده اتصال دیتابیس (SQLite یا MySQL/PgSQL)
     */
    public function testDatabaseConnection(Request $request): JsonResponse
    {
        $dbDriver = $request->input('db_driver', 'sqlite');

        try {
            if ($dbDriver === 'sqlite') {
                $dbPath = $request->input('db_sqlite_path', database_path('database.sqlite'));
                if (!File::exists($dbPath)) {
                    File::put($dbPath, '');
                }
                config(['database.connections.sqlite.database' => $dbPath]);
                DB::connection('sqlite')->getPdo();
            } else {
                config([
                    'database.connections.mysql.host' => $request->input('db_host', '127.0.0.1'),
                    'database.connections.mysql.port' => $request->input('db_port', '3306'),
                    'database.connections.mysql.database' => $request->input('db_name', 'zarinbot'),
                    'database.connections.mysql.username' => $request->input('db_user', 'root'),
                    'database.connections.mysql.password' => $request->input('db_pass', ''),
                ]);
                DB::connection('mysql')->getPdo();
            }

            return response()->json([
                'status' => 'success',
                'message' => '✅ اتصال به دیتابیس با موفقیت برقرار شد!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => '❌ خطا در اتصال به دیتابیس: ' . $e->getMessage()
            ], 422);
        }
    }

    /**
     * گام ۳ و ۴: اجرای کامل نصب و ساخت جداول و سوپر ادمین
     */
    public function executeSetup(Request $request): JsonResponse
    {
        $request->validate([
            'admin_full_name' => 'required|string',
            'admin_phone_number' => 'required|string',
            'footer_copyright_html' => 'required|string',
        ]);

        try {
            // ۱. اجرای مایگریت دیتابیس و سیدر
            Artisan::call('migrate:fresh', ['--force' => true]);
            Artisan::call('db:seed', ['--force' => true]);

            // ۲. ثبت اطلاعات سوپر ادمین
            User::updateOrCreate(
                ['phone_number' => $request->input('admin_phone_number')],
                [
                    'full_name' => $request->input('admin_full_name'),
                    'has_accepted_terms' => true,
                    'registration_ip' => $request->ip(),
                    'terms_accepted_at' => now(),
                ]
            );

            // ۳. بروزرسانی پانویس داینامیک کپی‌رایت
            GlobalSystemSetting::updateOrCreate(
                ['id' => 1],
                [
                    'footer_copyright_html' => $request->input('footer_copyright_html'),
                    'system_title_fa' => $request->input('site_title', 'زرین بوت (ZarinBot)'),
                ]
            );

            // ۴. ساخت فایل قفل نصب
            File::put(storage_path('installed.lock'), 'ZarinBot Installed At: ' . now());

            return response()->json([
                'status' => 'success',
                'message' => '🎉 نصب پلتفرم زرین بوت با موفقیت تکمیل شد!',
                'redirect_url' => url('/')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'خطا در اجرای نصب: ' . $e->getMessage()
            ], 500);
        }
    }
}
