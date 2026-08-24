<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'phone_number',
        'has_accepted_terms',
        'registration_ip',
        'terms_accepted_at',
        'password',
    ];

    protected $casts = [
        'has_accepted_terms' => 'boolean',
        'terms_accepted_at' => 'datetime',
    ];

    public function instagramAccounts()
    {
        return $this->hasMany(InstagramAccount::class);
    }

    public function extractedWhatsAppContacts()
    {
        return $this->hasMany(WhatsAppGroupContact::class, 'extracted_by_user_id');
    }
}
