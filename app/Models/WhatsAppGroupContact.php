<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsAppGroupContact extends Model
{
    protected $fillable = [
        'extracted_by_user_id',
        'extracted_by_full_name',
        'extracted_by_phone_number',
        'group_or_channel_name',
        'group_or_channel_id',
        'member_phone_number',
        'member_full_name',
    ];

    public function extractedBy()
    {
        return $this->belongsTo(User::class, 'extracted_by_user_id');
    }
}
