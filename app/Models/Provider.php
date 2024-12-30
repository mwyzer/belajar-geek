<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'location_id',
        'location_name',
        'provider_type',
        'numbers',
        'provider_status',
        'is_suk',
        'k1h',
        'pln_number',
        'pln_name',
        'wifi_private_pass',
        'wifi_main_pass',
        'status',
    ];

    protected $casts = [
        'numbers' => 'array',
        'is_suk' => 'boolean',
    ];

    protected $rules = [
        'location_id' => 'required|exists:locations,id',
        'provider_type' => 'required|string',
        'numbers' => 'required|array',
    ];

    /**
     * Get the location associated with the provider.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}

enum ProviderType: string 
{
    case TYPE_A = 'type_a';
    case TYPE_B = 'type_b';
}

