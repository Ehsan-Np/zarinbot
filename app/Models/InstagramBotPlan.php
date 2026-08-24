<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstagramBotPlan extends Model
{
    protected $fillable = [
        'title_fa',
        'price_toman',
        'duration_days',
        'bonus_days',
        'max_instagram_accounts',
        'enable_arena_ai',
        'enable_lead_miner',
        'is_active',
    ];

    protected $casts = [
        'price_toman' => 'decimal:2',
        'enable_arena_ai' => 'boolean',
        'enable_lead_miner' => 'boolean',
        'is_active' => 'boolean',
    ];
}
