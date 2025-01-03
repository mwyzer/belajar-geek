<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Qris;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QrisController extends Controller
{
    public function generate(Transaction $transaction)
    {
        $qris = Qris::create([
            'transaction_id' => $transaction->id,
            'merchant_id' => config('services.qris.merchant_id'),
            'qris_code' => $this->generateQrisCode($transaction),
            'amount' => $transaction->grand_total,
            'status' => 'pending',
            'expired_at' => Carbon::now()->addMinutes(30),
        ]);

        return inertia('Web/Payments/Qris', [
            'qris' => $qris,
            'transaction' => $transaction
        ]);
    }

    public function check(Qris $qris)
    {
        // Here you would implement actual QRIS payment status checking
        // This is a simplified example
        return response()->json([
            'status' => $qris->status,
            'expired' => $qris->isExpired()
        ]);
    }

    private function generateQrisCode(Transaction $transaction): string
    {
        // In real implementation, you would integrate with your QRIS provider
        // This is a placeholder implementation
        return 'QRIS' . time() . $transaction->id;
    }
}
