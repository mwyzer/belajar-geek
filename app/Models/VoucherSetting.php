<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_profile_id',
        'issue_voucher',
        'display_stock',
        'max_purchase_per_tx',
        'link_to_generate_voucher',
    ];

    public function voucherProfile()
    {
        return $this->belongsTo(VoucherProfile::class, 'voucher_profile_id');
    }
}
