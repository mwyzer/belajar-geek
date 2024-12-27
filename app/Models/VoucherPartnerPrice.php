<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherPartnerPrice extends Model
{
    use HasFactory;

    protected $fillable = ['voucherProfileId', 'partnerTypeId', 'pricePoints'];

    public function partnerType()
    {
        return $this->belongsTo(PartnerType::class, 'partnerTypeId');
    }
}