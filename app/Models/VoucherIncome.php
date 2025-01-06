<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherIncome extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_type_id',
        'income',
        'points',
        'created_at'
    ];

    public $timestamps = false;

    public function voucherType()
    {
        return $this->belongsTo(VoucherType::class, 'voucher_type_id');
    }
}
