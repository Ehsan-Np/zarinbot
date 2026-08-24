<?php

namespace App\Http\Controllers;

use App\Models\GlobalSystemSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingsAndCMSController extends Controller
{
    /**
     * نمایش یا ویرایش متن کپی‌رایت داینامیک پانویس
     */
    public function updateFooterCopyright(Request $request): JsonResponse
    {
        $request->validate([
            'footer_copyright_html' => 'required|string',
        ]);

        $settings = GlobalSystemSetting::firstOrCreate(['id' => 1]);
        $settings->update([
            'footer_copyright_html' => $request->input('footer_copyright_html')
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'متن پانویس کپی‌رایت با موفقیت بروزرسانی شد.',
            'data' => [
                'footer_copyright_html' => $settings->footer_copyright_html
            ]
        ]);
    }

    /**
     * دریافت تنظیمات عمومی سامانه
     */
    public function getSettings(): JsonResponse
    {
        $settings = GlobalSystemSetting::firstOrCreate(['id' => 1], [
            'footer_copyright_html' => '© تمامی حقوق برای زرین بات محفوظ می باشد. | احسان نادری پناه - 09024561001',
            'system_title_fa' => 'زرین بوت (ZarinBot)',
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $settings
        ]);
    }
}
