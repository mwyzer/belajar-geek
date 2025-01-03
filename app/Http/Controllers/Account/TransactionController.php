<?php

namespace App\Http\Controllers\Account;

use App\Models\Transaction;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * get role
         */
        $role = auth()->user()->getRoleNames();
        
        /**
         * get transactions
         */
        if ($role[0] == 'admin') {

            //get transactions
            $transactions = Transaction::with('user')->when(request()->q, function($categories) {
                $categories = $categories->where('invoice', 'like', '%'. request()->q . '%');
            })->latest()->paginate(5);

        } else {
            
            //get transactions
            $transactions = Transaction::with(['user:id,name,email,google_id'])->when(request()->q, function($categories) {
                $categories = $categories->where('invoice', 'like', '%'. request()->q . '%');
            })->where('user_id', auth()->user()->id)->latest()->paginate(5);

        }

        //append query string to pagination links
        $transactions->appends(['q' => request()->q]);

        //return inertia
        return inertia('Account/Transactions/Index', [
            'transactions' => $transactions,
        ]);
    }
    
    /**
     * show
     *
     * @param  mixed $invoice
     * @return void
     */
    public function show($invoice)
    {
        //get detail transaction by "reference"
        $transaction = Transaction::with([
            'user:id,name,email,google_id',
            'transactionDetails.product',
            'province',
            'city'
        ])->where('invoice', $invoice)->first();

        //return inertia
        return inertia('Account/Transactions/Show', [
            'transaction' => $transaction,
        ]);
    }



     /**
     * Get all transactions for a specific user including google_id.
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function userTransactions($userId)
    {
        // Get transactions for a specific user including google_id
        $transactions = Transaction::with(['user:id,name,email,google_id'])
            ->where('user_id', $userId)
            ->latest()
            ->paginate(5);

        // Return inertia
        return inertia('Account/Transactions/UserTransactions', [
            'transactions' => $transactions,
        ]);
    }




}