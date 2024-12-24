<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'whatsapp_number',
        'telegram_id',
        'account_type',
        'wa_plgn',
        'total_deposit'
    ];

    protected $appends = ['registration_date']; // Ensure this is appended to JSON

    // Add an accessor for registration_date
    public function getRegistrationDateAttribute()
    {
        return $this->created_at ? $this->created_at->format('Y-m-d') : null;
    }
}
