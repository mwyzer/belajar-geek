<?php

namespace App\Http\Controllers\Account;

use App\Models\ProviderLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ProviderLocationController extends Controller
{
    /**
     * Display a listing of the provider locations.
     */
    public function index()
    {
        $providerLocations = ProviderLocation::latest()->paginate(10);

        return Inertia::render('Account/ProviderLocations/Index', [
            'providerLocations' => $providerLocations,
        ]);
    }

    /**
     * Show the form for creating a new provider location.
     */
    public function create()
    {
        return Inertia::render('Account/ProviderLocations/Create');
    }

    /**
     * Store a newly created provider location.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'load_balance' => 'nullable|boolean',
            'provider_count' => 'nullable|integer',
            'provider_details' => 'nullable|array',
            'dedicated_service' => 'nullable|boolean',
            'broadband_service' => 'nullable|boolean',
            'voucher_service' => 'nullable|boolean',
            'partners' => 'nullable|array',
            'installation_date' => 'nullable|date',
            'google_map_url' => 'nullable|url',
        ]);

        ProviderLocation::create($validated);

        return redirect()->route('provider-locations.index')
                         ->with('success', 'Provider Location created successfully.');
    }

    /**
     * Display the specified provider location.
     */
    public function show(ProviderLocation $providerLocation)
    {
        return Inertia::render('Account/ProviderLocations/Show', [
            'providerLocation' => $providerLocation,
        ]);
    }

    /**
     * Show the form for editing the specified provider location.
     */
    public function edit(ProviderLocation $providerLocation)
    {
        return Inertia::render('Account/ProviderLocations/Edit', [
            'providerLocation' => $providerLocation,
        ]);
    }

    /**
     * Update the specified provider location.
     */
    public function update(Request $request, ProviderLocation $providerLocation)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'load_balance' => 'nullable|boolean',
            'provider_count' => 'nullable|integer',
            'provider_details' => 'nullable|array',
            'dedicated_service' => 'nullable|boolean',
            'broadband_service' => 'nullable|boolean',
            'voucher_service' => 'nullable|boolean',
            'partners' => 'nullable|array',
            'installation_date' => 'nullable|date',
            'google_map_url' => 'nullable|url',
        ]);

        $providerLocation->update($validated);

        return redirect()->route('provider-locations.index')
                         ->with('success', 'Provider Location updated successfully.');
    }

    /**
     * Remove the specified provider location.
     */
    public function destroy(ProviderLocation $providerLocation)
    {
        $providerLocation->delete();

        return redirect()->route('provider-locations.index')
                         ->with('success', 'Provider Location deleted successfully.');
    }
}
