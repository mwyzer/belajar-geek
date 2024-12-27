<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voucher extends Model
{
    protected $fillable = [
        'voucherProfileId',
        'code',
        'comment',
        'importDate',
        'status',
        'saleDate',
        'buyerName',
    ];

    /**
     * Relationship: Voucher belongs to a VoucherProfile.
     */
    public function voucherProfile(): BelongsTo
    {
        return $this->belongsTo(VoucherProfile::class, 'voucherProfileId');
    }
}
