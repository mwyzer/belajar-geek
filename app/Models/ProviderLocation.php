<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'load_balance',
        'provider_count',
        'provider_details',
        'dedicated_service',
        'broadband_service',
        'voucher_service',
        'partners',
        'installation_date',
        'google_map_url',
    ];

    protected $casts = [
        'load_balance' => 'boolean',
        'dedicated_service' => 'boolean',
        'broadband_service' => 'boolean',
        'voucher_service' => 'boolean',
        'provider_details' => 'array',
        'partners' => 'array',
        'installation_date' => 'date',
    ];
}
