<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationPartner extends Model
{
    //
    use HasFactory;

    protected $table = 'location_partners';

    protected $fillable = [
        'locationId',
        'partnerTypeId',
        'status',
        'maxCount',
        'filledCount',
        'createdAt',
    ];

    public $timestamps = false; // since createdAt is managed manually
}
