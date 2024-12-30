<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyBilling extends Model
{
    //
    use HasFactory;

    protected $table = 'daily_billings';

    protected $fillable = [
        'serviceId',
        'billingDate',
        'amount',
    ];
}
