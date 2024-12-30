<?php

namespace App\Http\Controllers;

use App\Models\PrepaidProvider;
use Illuminate\Http\Request;

class PrepaidProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $providers = PrepaidProvider::with('location')->get();
        return response()->json($providers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'locationId' => 'required|exists:locations,id',
            'position' => 'nullable|string|max:255',
            'holders' => 'nullable|array',
            'status' => 'required|in:Terpasang,Stand By,Bermasalah',
            'email_login' => 'nullable|email',
            'open_accounting_date' => 'nullable|date',
            'limit' => 'required|integer',
            'system_refill' => 'boolean',
            'manual_package' => 'boolean',
            'packages' => 'nullable|array',
            'other_charges' => 'nullable|numeric',
        ]);

        $provider = PrepaidProvider::create($validated);

        return response()->json(['message' => 'Provider created successfully', 'provider' => $provider], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PrepaidProvider $prepaidProvider)
    {
        //
        return response()->json($prepaidProvider->load('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrepaidProvider $prepaidProvider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrepaidProvider $prepaidProvider)
    {
        //
        $validated = $request->validate([
            'number' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'locationId' => 'required|exists:locations,id',
            'position' => 'nullable|string|max:255',
            'holders' => 'nullable|array',
            'status' => 'required|in:Terpasang,Stand By,Bermasalah',
            'email_login' => 'nullable|email',
            'open_accounting_date' => 'nullable|date',
            'limit' => 'required|integer',
            'system_refill' => 'boolean',
            'manual_package' => 'boolean',
            'packages' => 'nullable|array',
            'other_charges' => 'nullable|numeric',
        ]);

        $prepaidProvider->update($validated);

        return response()->json(['messge' => 'Provider updated successfully', 'provider' => $prepaidProvider]);
    }

       /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrepaidProvider $prepaidProvider)
    {
        $prepaidProvider->delete();
        return response()->json(['message' => 'Provider deleted successfully']);
    }

       /**
     * Add a package dynamically.
     */
    public function addPackage(Request $request, $id)
    {
        $validated = $request->validate([
            'quota' => 'required|string',
            'validity' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $provider = PrepaidProvider::findOrFail($id);
        $packages = $provider->packages ?? [];
        $packages[] = $validated;

        $provider->packages = $packages;
        $provider->save();

        return response()->json(['message' => 'Package added successfully', 'packages' => $packages]);
    }

     /**
     * Remove a package dynamically.
     */
    public function removePackage($id, $index)
    {
        $provider = PrepaidProvider::findOrFail($id);
        $packages = $provider->packages ?? [];

        if (isset($packages[$index])) {
            unset($packages[$index]);
            $provider->packages = array_values($packages); // Re-index array
            $provider->save();

            return response()->json(['message' => 'Package removed successfully', 'packages' => $packages]);
        }

        return response()->json(['error' => 'Package not found'], 404);
    }

}
