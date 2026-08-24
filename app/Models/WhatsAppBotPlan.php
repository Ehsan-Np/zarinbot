<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsAppBotPlan extends Model
{
    protected $fillable = [
        'title_fa',
        'price_toman',
        'duration_days',
        'bonus_days',
        'max_whatsapp_accounts',
        'enable_group_scraper',
        'enable_anti_ban',
        'is_active',
    ];

    protected $casts = [
        'price_toman' => 'decimal:2',
        'enable_group_scraper' => 'boolean',
        'enable_anti_ban' => 'boolean',
        'is_active' => 'boolean',
    ];
}
