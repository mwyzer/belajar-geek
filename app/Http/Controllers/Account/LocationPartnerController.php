<?php

namespace App\Http\Controllers\Account;

use App\Models\LocationPartner;
use App\Models\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LocationPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = LocationPartner::with('location')
            ->when(request()->q, function ($query) {
                $query->where('status', 'like', '%' . request()->q . '%');
            })
            ->latest()
            ->paginate(10);

        $partners->appends(['q' => request()->q]);

        return Inertia::render('Account/LocationPartners/Index', [
            'partners' => $partners,
            'filters' => request()->only('q'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all(['id', 'name']);
        
        return Inertia::render('Account/LocationPartners/Create', [
            'locations' => $locations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'locationId' => 'required|exists:locations,id',
            'partnerTypeId' => 'required|integer',
            'status' => 'required|string|max:255',
            'maxCount' => 'required|integer',
            'filledCount' => 'nullable|integer',
        ]);

        LocationPartner::create($validated);

        return redirect()->route('account.location-partners.index')
            ->with('success', 'Location Partner created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LocationPartner $locationPartner)
    {
        return Inertia::render('Account/LocationPartners/Show', [
            'partner' => $locationPartner->load('location'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocationPartner $locationPartner)
    {
        $locations = Location::all(['id', 'name']);

        return Inertia::render('Account/LocationPartners/Edit', [
            'partner' => $locationPartner,
            'locations' => $locations,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LocationPartner $locationPartner)
    {
        $validated = $request->validate([
            'locationId' => 'required|exists:locations,id',
            'partnerTypeId' => 'required|integer',
            'status' => 'required|string|max:255',
            'maxCount' => 'required|integer',
            'filledCount' => 'nullable|integer',
        ]);

        $locationPartner->update($validated);

        return redirect()->route('account.location-partners.index')
            ->with('success', 'Location Partner updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocationPartner $locationPartner)
    {
        $locationPartner->delete();

        return redirect()->route('account.location-partners.index')
            ->with('success', 'Location Partner deleted successfully!');
    }
}