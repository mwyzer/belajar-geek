<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_online',
        'is_offline',

    ];

    public function incomes()
    {
        return $this->hasMany(VoucherIncome::class, 'voucher_type_id');
    }
}
