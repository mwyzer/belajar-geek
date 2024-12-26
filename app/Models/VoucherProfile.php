<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_name',
        'quota',
        'quota_unit',
        'active_period',
        'active_unit',
        'stock_warning',
        'stock_alert',
        'is_published',
        'show_stock',
        'max_purchase_per_transaction',
        'generate_link',
    ];
}
