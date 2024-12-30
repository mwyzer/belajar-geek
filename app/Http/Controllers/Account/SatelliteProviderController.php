<?php

namespace App\Http\Controllers\Account;

use App\Models\SatelliteProvider;
use App\Models\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SatelliteProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers = SatelliteProvider::with('location')
            ->when(request()->q, function ($query) {
                $query->where('provider_type', 'like', '%' . request()->q . '%')
                      ->orWhere('location_name', 'like', '%' . request()->q . '%');
            })
            ->latest()
            ->paginate(10);

        $providers->appends(['q' => request()->q]);

        return Inertia::render('Account/Providers/Index', [
            'providers' => $providers,
            'filters' => request()->only('q'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all(['id', 'name']);

        return Inertia::render('Account/Providers/Create', [
            'locations' => $locations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'provider_type' => 'required|string|max:255',
            'numbers' => 'required|array',
            'provider_status' => 'required|string',
            'is_suk' => 'required|boolean',
            'k1h' => 'nullable|string',
            'pln_number' => 'nullable|string',
            'pln_name' => 'nullable|string',
            'wifi_private_pass' => 'nullable|string',
            'wifi_main_pass' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $location = Location::findOrFail($validated['location_id']);

        SatelliteProvider::create([
            'location_id' => $validated['location_id'],
            'location_name' => Location::find($validated['location_id'])->name,
            'provider_type' => $validated['provider_type'],
            'numbers' => $validated['numbers'],
            'provider_status' => $validated['provider_status'],
            'is_suk' => $validated['is_suk'],
            'k1h' => $validated['k1h'],
            'pln_number' => $validated['pln_number'],
            'pln_name' => $validated['pln_name'],
            'wifi_private_pass' => $validated['wifi_private_pass'],
            'wifi_main_pass' => $validated['wifi_main_pass'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('account.providers.index')->with('success', 'Provider created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SatelliteProvider $provider)
    {
        return Inertia::render('Account/Providers/Show', [
            'provider' => $provider->load('location'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SatelliteProvider $provider)
    {
        $locations = Location::all(['id', 'name']);

        return Inertia::render('Account/Providers/Edit', [
            'provider' => $provider,
            'locations' => $locations,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SatelliteProvider $provider)
    {
        $validated = $request->validate([
            'location_id' => 'required|exists:locations,id',
            'provider_type' => 'required|string|max:255',
            'numbers' => 'required|array',
            'provider_status' => 'required|string',
            'is_suk' => 'required|boolean',
            'k1h' => 'nullable|string',
            'pln_number' => 'nullable|string',
            'pln_name' => 'nullable|string',
            'wifi_private_pass' => 'nullable|string',
            'wifi_main_pass' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $provider->update([
            'location_id' => $validated['location_id'],
            'location_name' => Location::find($validated['location_id'])->name,
            'provider_type' => $validated['provider_type'],
            'numbers' => $validated['numbers'],
            'provider_status' => $validated['provider_status'],
            'is_suk' => $validated['is_suk'],
            'k1h' => $validated['k1h'],
            'pln_number' => $validated['pln_number'],
            'pln_name' => $validated['pln_name'],
            'wifi_private_pass' => $validated['wifi_private_pass'],
            'wifi_main_pass' => $validated['wifi_main_pass'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('account.providers.index')->with('success', 'Provider updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SatelliteProvider $provider)
    {
        $provider->delete();

        return redirect()->route('account.providers.index')->with('success', 'Provider deleted successfully!');
    }
}
