<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\CmsPage;
use App\Models\GlobalSystemSetting;
use App\Models\InstagramBotPlan;
use App\Models\RestrictedPromoCode;
use App\Models\WhatsAppBotPlan;
use Illuminate\Database\Seeder;

class ZarinBotSeeder extends Seeder
{
    public function run(): void
    {
        // 1. تنظیمات عمومی کپی‌رایت و ربات‌ها
        GlobalSystemSetting::updateOrCreate(
            ['id' => 1],
            [
                'footer_copyright_html' => '© تمامی حقوق برای زرین بات محفوظ می باشد. | احسان نادری پناه - 09024561001',
                'system_title_fa' => 'زرین بوت (ZarinBot)',
                'telegram_reward_discount_percent' => 5.00,
                'bale_reward_discount_percent' => 5.00,
                'rubika_reward_discount_percent' => 5.00,
            ]
        );

        // 2. پلن‌های اشتراک اینستاگرام
        InstagramBotPlan::updateOrCreate(
            ['title_fa' => 'پلن برنزی اینستاگرام (استارتاپی)'],
            [
                'price_toman' => 490000,
                'duration_days' => 30,
                'bonus_days' => 0,
                'max_instagram_accounts' => 1,
                'enable_arena_ai' => false,
                'enable_lead_miner' => false,
                'is_active' => true,
            ]
        );

        InstagramBotPlan::updateOrCreate(
            ['title_fa' => 'پلن طلایی اینستاگرام (کسب‌وکار حرفه‌ای)'],
            [
                'price_toman' => 990000,
                'duration_days' => 30,
                'bonus_days' => 5,
                'max_instagram_accounts' => 3,
                'enable_arena_ai' => true,
                'enable_lead_miner' => true,
                'is_active' => true,
            ]
        );

        // 3. پلن‌های اشتراک واتساپ
        WhatsAppBotPlan::updateOrCreate(
            ['title_fa' => 'پلن استاندارد ارسال پیام واتساپ'],
            [
                'price_toman' => 590000,
                'duration_days' => 30,
                'bonus_days' => 0,
                'max_whatsapp_accounts' => 1,
                'enable_group_scraper' => true,
                'enable_anti_ban' => true,
                'is_active' => true,
            ]
        );

        WhatsAppBotPlan::updateOrCreate(
            ['title_fa' => 'پلن پیشرفته استخراج اعضای گروه‌ها و مارکتینگ واتساپ'],
            [
                'price_toman' => 1290000,
                'duration_days' => 30,
                'bonus_days' => 10,
                'max_whatsapp_accounts' => 5,
                'enable_group_scraper' => true,
                'enable_anti_ban' => true,
                'is_active' => true,
            ]
        );

        // 4. کد تخفیف ویژه
        RestrictedPromoCode::updateOrCreate(
            ['code' => 'ZARIN_2026'],
            [
                'title_fa' => 'کد تخفیف ویژه رونمایی زرین بوت',
                'discount_percent' => 20.00,
                'is_restricted_to_phone' => false,
                'max_usage_total' => 500,
                'is_active' => true,
            ]
        );

        // 5. صفحات متون حقوقی فتا
        CmsPage::updateOrCreate(
            ['slug' => 'terms'],
            [
                'title_fa' => 'قوانین و شرایط استفاده مطابق با الزامات پلیس فتا و تجارت الکترونیکی',
                'content_html_fa' => '<h2>قوانین و شرایط استفاده از زرین بوت</h2><p>این خدمات مطابق قوانین پلیس فتا و تجارت الکترونیکی ارائه می‌گردد...</p>',
            ]
        );

        CmsPage::updateOrCreate(
            ['slug' => 'privacy'],
            [
                'title_fa' => 'حریم خصوصی و امنیت اطلاعات کاربران',
                'content_html_fa' => '<h2>حریم خصوصی در زرین بوت</h2><p>تمامی داده‌های حساس با الگوریتم AES-256 رمزنگاری می‌شوند...</p>',
            ]
        );

        // 6. مقاله نمونه سئو وبلاگ
        BlogPost::updateOrCreate(
            ['slug' => 'instagram-growth-2026'],
            [
                'title_fa' => 'راهنمای جامع رشد ارگانیک اینستاگرام در سال ۲۰۲۶ بدون شادوبن',
                'category' => 'آموزش اینستاگرام',
                'author_name' => 'احسان نادری پناه',
                'excerpt_fa' => 'در این مقاله راهکارهای هوشمند الگوریتم متا جهت جلب تعامل ارگانیک و روش‌های پیشگیری از شادوبن بررسی شده است.',
                'full_wysiwyg_html' => '<h1>راهنمای رشد ارگانیک اینستاگرام ۲۰۲۶</h1><p>با هوش مصنوعی زرین بوت تعامل ارگانیک خود را چند برابر کنید...</p>',
                'meta_title' => 'اینستاگرام, رشد ارگانیک, زرین بوت, شادوبن',
                'meta_description' => 'آموزش رشد ارگانیک پیج‌های اینستاگرام بدون شادوبن با ابزارهای زرین بوت',
                'estimated_reading_time' => 8,
                'is_published' => true,
            ]
        );
    }
}
