<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function voucherPartnerPrices()
    {
        return $this->hasMany(VoucherPartnerPrice::class, 'partnerTypeId');
    }
}