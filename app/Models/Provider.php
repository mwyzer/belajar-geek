<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'provider',
        'number',
        'position',
        'owner',
        'status',
        'load_balance',
        'location_id',
    ];

    protected $casts = [
        'numbers' => 'array',

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
        return $this->belongsTo(Location::class, 'location_id');
    }


}
