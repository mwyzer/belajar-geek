<?php

namespace App\Http\Controllers\Account;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get customers with related status histories
        $customers = Customer::with('statusHistories')
            ->when(request()->q, function ($query) {
                $query->where('customerName', 'like', '%' . request()->q . '%');
            })
            ->latest()
            ->paginate(10);

        // Append query string to pagination links
        $customers->appends(['q' => request()->q]);

        // Render with Inertia
        return inertia('Account/Customer/Index', [
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Render create form with Inertia
        return inertia('Account/Customer/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'customerTitle'          => 'required|string|max:255',
            'customerName'           => 'required|string|max:255',
            'customerWhatsappNumber' => 'nullable|string|max:255',
            'customerLocation'       => 'required|string|max:255',
            'customerOccupation'     => 'nullable|string|max:255',
            'customerPosition'       => 'nullable|string|max:255',
            'membershipLevelId'      => 'required|integer',
        ]);

        // Create customer
        Customer::create($validated);

        // Redirect with success message
        return redirect()->route('account.customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        // Render edit form with Inertia
        return inertia('Account/Customer/Edit', [
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        // Validate the request
        $validated = $request->validate([
            'customerTitle'          => 'required|string|max:255',
            'customerName'           => 'required|string|max:255',
            'customerWhatsappNumber' => 'nullable|string|max:255',
            'customerLocation'       => 'required|string|max:255',
            'customerOccupation'     => 'nullable|string|max:255',
            'customerPosition'       => 'nullable|string|max:255',
            'membershipLevelId'      => 'required|integer',
        ]);

        // Update customer
        $customer->update($validated);

        // Redirect with success message
        return redirect()->route('account.customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        // Delete customer
        $customer->delete();

        // Redirect with success message
        return redirect()->route('account.customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
