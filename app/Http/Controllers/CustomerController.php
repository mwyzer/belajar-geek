<?php

// app/Http/Controllers/CustomerController.php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('statusHistories')->get();
        return inertia('Customer/Index', ['customers' => $customers]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customerTitle' => 'required|string|max:255',
            'customerName' => 'required|string|max:255',
            'customerWhatsappNumber' => 'nullable|string|max:255',
            'customerLocation' => 'required|string|max:255',
            'customerOccupation' => 'nullable|string|max:255',
            'customerPosition' => 'nullable|string|max:255',
            'membershipLevelId' => 'required|integer',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
