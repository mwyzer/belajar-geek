<?php

namespace App\Http\Controllers;

use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
{
    public function index()
    {
        $transactionTypes = TransactionType::all();
        return inertia('TransactionTypes/Index', ['transactionTypes' => $transactionTypes]);
    }

    public function store(Request $request)
    {
        $request->validate(['typeName' => 'required|string|max:255']);
        TransactionType::create($request->all());
        return redirect()->back()->with('success', 'Transaction Type created successfully.');
    }

    public function destroy(TransactionType $transactionType)
    {
        $transactionType->delete();
        return redirect()->back()->with('success', 'Transaction Type deleted successfully.');
    }
}
