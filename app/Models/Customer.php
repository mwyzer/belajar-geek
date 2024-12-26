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
        'total_deposit',
        'type', // 'member', 'pelanggan', 'mitra'
        'ktp', // pelanggan
        'passport', // pelanggan
        'membership_level', // member
        'mitra_type' // mitra
    ];

    protected $appends = ['registration_date'];

    public function getRegistrationDateAttribute()
    {
        return $this->created_at ? $this->created_at->format('Y-m-d') : null;
    }

    // Scopes for filtering by type
    public function scopeMembers($query)
    {
        return $query->where('type', 'member');
    }

    public function scopePelanggan($query)
    {
        return $query->where('type', 'pelanggan');
    }

    public function scopeMitra($query)
    {
        return $query->where('type', 'mitra');
    }
}
