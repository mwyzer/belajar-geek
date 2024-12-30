<?php

namespace App\Http\Controllers;

use App\Models\ProviderLocation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProviderLocationController extends Controller
{
    public function index()
    {
        $locations = ProviderLocation::latest()->paginate(10);
        return Inertia::render('ProviderLocations/Index', [
            'locations' => $locations,
        ]);
    }

    public function create()
    {
        return Inertia::render('ProviderLocations/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'load_balance' => 'boolean',
            'provider_count' => 'integer',
            'provider_details' => 'array',
            'dedicated_service' => 'boolean',
            'broadband_service' => 'boolean',
            'voucher_service' => 'boolean',
            'partners' => 'array',
            'installation_date' => 'date',
            'google_map_url' => 'nullable|url',
        ]);

        ProviderLocation::create($validated);

        return redirect()->route('provider-locations.index')
                         ->with('success', 'Provider Location created successfully.');
    }

    public function show(ProviderLocation $providerLocation)
    {
        return Inertia::render('ProviderLocations/Show', [
            'location' => $providerLocation,
        ]);
    }

    public function edit(ProviderLocation $providerLocation)
    {
        return Inertia::render('ProviderLocations/Edit', [
            'location' => $providerLocation,
        ]);
    }

    public function update(Request $request, ProviderLocation $providerLocation)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'load_balance' => 'boolean',
            'provider_count' => 'integer',
            'provider_details' => 'array',
            'dedicated_service' => 'boolean',
            'broadband_service' => 'boolean',
            'voucher_service' => 'boolean',
            'partners' => 'array',
            'installation_date' => 'date',
            'google_map_url' => 'nullable|url',
        ]);

        $providerLocation->update($validated);

        return redirect()->route('provider-locations.index')
                         ->with('success', 'Provider Location updated successfully.');
    }

    public function destroy(ProviderLocation $providerLocation)
    {
        $providerLocation->delete();

        return redirect()->route('provider-locations.index')
                         ->with('success', 'Provider Location deleted successfully.');
    }
}
