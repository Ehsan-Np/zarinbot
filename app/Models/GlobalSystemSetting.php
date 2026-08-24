<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalSystemSetting extends Model
{
    protected $table = 'global_system_settings';

    protected $fillable = [
        'footer_copyright_html',
        'system_title_fa',
        'telegram_reward_discount_percent',
        'bale_reward_discount_percent',
        'rubika_reward_discount_percent',
    ];

    protected $casts = [
        'telegram_reward_discount_percent' => 'decimal:2',
        'bale_reward_discount_percent' => 'decimal:2',
        'rubika_reward_discount_percent' => 'decimal:2',
    ];
}
