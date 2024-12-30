<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailySales extends Model
{
    //

    use HasFactory;

    protected $table = 'daily_sales';

    protected $fillable = [
        'locationId',
        'salesMonth',
        'incomeAmount'
    ];

}
