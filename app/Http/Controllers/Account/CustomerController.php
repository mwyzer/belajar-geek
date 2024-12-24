<?php

namespace App\Http\Controllers\Account;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::when(request()->q, function ($query) {
                $query->where('name', 'like', '%' . request()->q . '%');
            })
            ->latest()
            ->paginate(10);

        $customers->appends(['q' => request()->q]);

        return Inertia::render('Account/Customers/Index', [
            'customers' => $customers,
            'filters' => request()->only('q'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Account/Customers/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp_number' => 'nullable|string|max:15',
            'telegram_id' => 'nullable|string|max:50',
            'account_type' => 'nullable|string|max:50',
            'wa_plgn' => 'nullable|string|max:50',
            'total_deposit' => 'nullable|numeric|min:0',
            'registration_date' => 'nullable|date',
        ]);

        // Set registration_date if not provided
        if (!$request->has('registration_date')) {
            $validated['registration_date'] = now();
        }

        // Create Customer
        $customer = Customer::create($validated);

        return redirect()->route('account.customers.index')->with('success', 'Customer created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return Inertia::render('Account/Customers/Show', [
            'customer' => $customer,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return Inertia::render('Account/Customers/Edit', [
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp_number' => 'nullable|string|max:15',
            'telegram_id' => 'nullable|string|max:50',
            'account_type' => 'nullable|string|max:50',
            'wa_plgn' => 'nullable|string|max:50',
            'total_deposit' => 'nullable|numeric|min:0',
            'registration_date' => 'nullable|date',
        ]);

        $customer->update($validated);

        return redirect()->route('account.customers.index')->with('success', 'Customer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('account.customers.index')->with('success', 'Customer deleted successfully!');
    }
}
