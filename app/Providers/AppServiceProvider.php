<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // پشتیبانی ۱۰۰٪ خودکار از هرگونه دامنه، زیردامنه (Subdomain) یا ساب‌فولدر (Subfolder)
        // بدون نیاز به هاردکد کردن هیچ دامنه‌ای در فایل .env
        if (isset($_SERVER['HTTP_HOST'])) {
            $scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
            $baseUrl = $scheme . '://' . $_SERVER['HTTP_HOST'];
            
            // در صورتی که برنامه در ساب‌فولدر نصب شده باشد
            $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
            $subFolder = dirname($scriptName);
            if ($subFolder !== '/' && $subFolder !== '\\') {
                $subFolder = str_replace('/public', '', $subFolder);
                $baseUrl .= $subFolder;
            }

            config(['app.url' => rtrim($baseUrl, '/')]);
            URL::forceRootUrl(rtrim($baseUrl, '/'));
        }
    }
}
