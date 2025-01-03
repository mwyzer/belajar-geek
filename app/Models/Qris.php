<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Qris extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'merchant_id',
        'qris_code',
        'amount',
        'status',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];

    /**
     * Get the transaction associated with the QRIS payment
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Check if QRIS payment is expired
     */
    public function isExpired(): bool
    {
        return Carbon::now()->isAfter($this->expired_at);
    }

    /**
     * Set payment as paid
     */
    public function markAsPaid(): void
    {
        $this->update(['status' => 'paid']);
        $this->transaction->update(['status' => 'paid']);
    }
}
