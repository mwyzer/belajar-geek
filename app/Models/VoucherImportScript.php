<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherImportScript extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'password',
        'profile',
        'comment',
        'limit_bytes_total',
        'created_at',
    ];

    public const UPDATED_AT = null; // Disable `updated_at`

    public $timestamps = true; // Enable timpstamps, but only `created_at` will work
}
