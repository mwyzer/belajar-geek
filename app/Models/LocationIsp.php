<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationIsp extends Model
{
    //
    use HasFactory;

    protected $table = 'location_isps';

    protected $fillable = [
        'locationId',
        'ispId',
        'ispType',
        'contactNumber',
    ];
}
