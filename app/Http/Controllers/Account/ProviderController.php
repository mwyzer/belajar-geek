<?php

namespace App\Http\Controllers\Account;

use App\Models\Provider;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get providers with search functionality
        $providers = Provider::when(request()->q, function ($query) {
            $query->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(5);

        // Append search query to pagination links
        $providers->appends(['q' => request()->q]);

        return inertia('Account/Providers/Index', [
            'providers' => $providers,
        ]);
    }
    /**
      * Show the form for creating a new resource.
      */
    public function create()
    {
        $locations = Location::select('id', 'name')->get();
        
        return inertia('Account/Providers/Create', [
            'locations' => $locations
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'provider' => 'required|string',
            'number' => 'required|string',
            'position' => 'required|string',
            'owner' => 'required|string',
            'status' => 'required|string',
            'load_balance' => 'required|boolean',
            'location_id' => 'required|exists:locations,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/providers', $image->hashName());
            $validated['image'] = $image->hashName();
        }

        // Create provider
        Provider::create($validated);

        return redirect()->route('account.providers.index')
                         ->with('success', 'Provider created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $provider = Provider::findOrFail($id);

        return inertia('Account/Providers/Edit', [
            'provider' => $provider,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provider $provider)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'provider' => 'required|string',
            'number' => 'required|string',
            'position' => 'required|string',
            'owner' => 'required|string',
            'status' => 'required|string',
            'load_balance' => 'required|boolean',
            'location_id' => 'required|exists:locations,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload and delete old image if a new one is uploaded
        if ($request->hasFile('image')) {
            Storage::disk('local')->delete('public/providers/' . basename($provider->image));
            $image = $request->file('image');
            $image->storeAs('public/providers', $image->hashName());
            $validated['image'] = $image->hashName();
        }

        // Update provider
        $provider->update($validated);

        return redirect()->route('account.providers.index')
                         ->with('success', 'Provider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $provider = Provider::findOrFail($id);

        // Delete associated image if exists
        if ($provider->image) {
            Storage::disk('local')->delete('public/providers/' . basename($provider->image));
        }

        // Delete provider
        $provider->delete();

        return redirect()->route('account.providers.index')
                         ->with('success', 'Provider deleted successfully.');
    }
}
