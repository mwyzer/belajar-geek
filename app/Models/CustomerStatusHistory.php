<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = ['customerId', 'status', 'changedAt'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerId');
    }
}
