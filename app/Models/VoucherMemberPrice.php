<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherMemberPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_profile_id',
        'member_level_id',
        'price_points',
    ];

    /**
     * Relationship with VoucherProfile.
     */
    public function voucherProfile()
    {
        return $this->belongsTo(VoucherProfile::class, 'voucher_profile_id');
    }

    /**
     * Relationship with MemberLevel.
     */
    public function memberLevel()
    {
        return $this->belongsTo(MemberLevel::class, 'member_level_id');
    }
}
