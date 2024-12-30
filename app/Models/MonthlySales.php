<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlySales extends Model
{
    //
    use HasFactory;
    
    protected $table = 'monthly_sales';

    protected $fillable = [
        'locationId',
        'salesMonth',
        'incomeAmount'
    ];

}
