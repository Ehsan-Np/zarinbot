<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. کاربران و لاگ پذیرش قوانین فتا
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name'); // فیلد یکپارچه نام و نام خانوادگی
            $table->string('phone_number')->unique();
            $table->boolean('has_accepted_terms')->default(true); // پذیرش الزامی قوانین فتا
            $table->string('registration_ip')->nullable();
            $table->timestamp('terms_accepted_at')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });

        // 2. اکانت‌های اینستاگرام
        Schema::create('instagram_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('instagram_username');
            $table->string('encrypted_session_data');
            $table->string('proxy_ip')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 3. پلن‌های اشتراک مجزای اینستاگرام و واتساپ (Dual-SaaS)
        Schema::create('instagram_bot_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title_fa');
            $table->decimal('price_toman', 12, 2);
            $table->integer('duration_days')->default(30);
            $table->integer('bonus_days')->default(0);
            $table->integer('max_instagram_accounts')->default(1);
            $table->boolean('enable_arena_ai')->default(true);
            $table->boolean('enable_lead_miner')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('whatsapp_bot_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title_fa');
            $table->decimal('price_toman', 12, 2);
            $table->integer('duration_days')->default(30);
            $table->integer('bonus_days')->default(0);
            $table->integer('max_whatsapp_accounts')->default(1);
            $table->boolean('enable_group_scraper')->default(true);
            $table->boolean('enable_anti_ban')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 4. کدهای تخفیف با محدودیت شماره تلفن (Restricted Promo Codes)
        Schema::create('restricted_promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title_fa');
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->decimal('fixed_discount_toman', 12, 2)->default(0);
            $table->boolean('is_restricted_to_phone')->default(false);
            $table->string('restricted_phone_number')->nullable();
            $table->integer('max_usage_total')->default(100);
            $table->integer('current_usage_total')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 5. استخراج شماره‌های گروه‌های واتساپ (با ردگیری دقیق)
        Schema::create('whatsapp_group_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('extracted_by_user_id')->constrained('users');
            $table->string('extracted_by_full_name');
            $table->string('extracted_by_phone_number');
            $table->string('group_or_channel_name');
            $table->string('group_or_channel_id');
            $table->string('member_phone_number');
            $table->string('member_full_name')->nullable();
            $table->timestamps();
        });

        // 6. وبلاگ پیشرفته با ادیتور WYSIWYG و سئو
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title_fa');
            $table->string('slug')->unique();
            $table->string('category')->default('آموزش تخصصی');
            $table->string('author_name')->default('احسان نادری پناه');
            $table->text('excerpt_fa')->nullable();
            $table->longText('full_wysiwyg_html');
            $table->string('featured_image_url')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->integer('estimated_reading_time')->default(5);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // 7. تنظیمات عمومی و پانویس داینامیک HTML
        Schema::create('global_system_settings', function (Blueprint $table) {
            $table->id();
            $table->text('footer_copyright_html');
            $table->string('system_title_fa')->default('زرین بوت (ZarinBot)');
            $table->decimal('telegram_reward_discount_percent', 5, 2)->default(5.00);
            $table->decimal('bale_reward_discount_percent', 5, 2)->default(5.00);
            $table->decimal('rubika_reward_discount_percent', 5, 2)->default(5.00);
            $table->timestamps();
        });

        // 8. متون حقوقی فتا و ای‌نماد
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_fa');
            $table->longText('content_html_fa');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cms_pages');
        Schema::dropIfExists('global_system_settings');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('whatsapp_group_contacts');
        Schema::dropIfExists('restricted_promo_codes');
        Schema::dropIfExists('whatsapp_bot_plans');
        Schema::dropIfExists('instagram_bot_plans');
        Schema::dropIfExists('instagram_accounts');
        Schema::dropIfExists('users');
    }
};
