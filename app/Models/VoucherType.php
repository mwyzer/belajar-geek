<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    //
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'voucher_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'is_online',
        'is_offline',
    ];

    /**
     * Automatically validate the `is_online` and `is_offline` values when the model is saved.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($voucherType) {
            if (!in_array($voucherType->type, ['limited', 'unlimited'])) {
                throw new \Exception('Invalid voucher type: must be either "limited" or "unlimited".');
            }

            if ($voucherType->is_online !== true || $voucherType->is_offline !== true) {
                throw new \Exception('Both "is_online" and "is_offline" must be true for all voucher types.');
            }
        });
    }
}
