<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyBilling extends Model
{
    //
    
    use HasFactory, SoftDeletes;

    protected $table = 'monthly_billings';

    protected $fillable = [
        'location_id',
        'billing_date',
        'amount',
    ];

     /**
     * Relationship to Location
     * Each DailyBilling belongs to one Location.
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id'); // Maps `location_id` to `id` in `locations` table
    }
}
