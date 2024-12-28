<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationDetail extends Model
{
    //
    use HasFactory;

    protected $table = 'location_details';

    protected $fillable = [
        'locationId',
        'initialInstallationDate',
        'googleMapUrl',
    ];
}
