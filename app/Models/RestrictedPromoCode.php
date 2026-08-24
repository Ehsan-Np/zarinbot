<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestrictedPromoCode extends Model
{
    protected $fillable = [
        'code',
        'title_fa',
        'discount_percent',
        'fixed_discount_toman',
        'is_restricted_to_phone',
        'restricted_phone_number',
        'max_usage_total',
        'current_usage_total',
        'is_active',
    ];

    protected $casts = [
        'discount_percent' => 'decimal:2',
        'fixed_discount_toman' => 'decimal:2',
        'is_restricted_to_phone' => 'boolean',
        'is_active' => 'boolean',
    ];
}
