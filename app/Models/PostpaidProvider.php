<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostpaidProvider extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'number',
        'provider',
        'locationId',
        'position',
        'holder',
        'status',
        'limit'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'locationId');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'providerId');
    }   
}
