<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Fillable attributes for mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'province_id',
        'city_id',
        'invoice',
        'courier_name',
        'courier_service',
        'courier_cost',
        'weight',
        'grand_total',
        'status',
        'reference',
        'address',
    ];

    /**
     * Define the relationship with TransactionDetail.
     *
     * @return HasMany
     */
    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class);
    }

    /**
     * Define the relationship with User.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship with Province.
     *
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Define the relationship with City.
     *
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Format createdAt attribute.
     *
     * @return Attribute
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->translatedFormat('l, d F Y'),
        );
    }
}
