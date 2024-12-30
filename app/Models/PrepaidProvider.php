<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrepaidProvider extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'number',
        'provider',
        'locationId',
        'position',
        'status',
        'email_login',
        'open_accounting_date',
        'holders',
        'system_refill',
        'manual_package',
        'packages',
        'other_charges'
    ];

    protected $casts = [
        'holders' => 'array',
        'packages' => 'array',
        'system_refill' => 'boolean',
        'manual_package' => 'boolean',
        'other_charges' => 'decimal:2'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'locationId');
    }
}
