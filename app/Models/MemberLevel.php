<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Relationship with VoucherMemberPrice.
     */
    public function voucherMemberPrices()
    {
        return $this->hasMany(VoucherMemberPrice::class, 'member_level_id');
    }
}
