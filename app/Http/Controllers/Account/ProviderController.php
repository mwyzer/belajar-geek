<?php

namespace App\Http\Controllers\Account;

use App\Models\Provider;
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
        $providers = Provider::latest()->paginate(5);

        return inertia('Account/Providers/Index', [
            'providers' => $providers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Account/Providers/Create');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public/providers');
        }

        Provider::create($validated);

        return redirect()->route('account.providers.index')
                         ->with('success', 'Provider created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        return inertia('Account/Providers/Show', [
            'provider' => $provider,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provider $provider)
    {
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
            'name' => 'string',
            'type' => 'string',
            'provider' => 'string',
            'number' => 'string',
            'position' => 'string',
            'owner' => 'string',
            'status' => 'string',
            'load_balance' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('local')->delete($provider->image);
            $validated['image'] = $request->file('image')->store('public/providers');
        }

        $provider->update($validated);

        return redirect()->route('account.providers.index')
                         ->with('success', 'Provider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {
        if ($provider->image) {
            Storage::disk('local')->delete($provider->image);
        }

        $provider->delete();

        return redirect()->route('account.providers.index')
                         ->with('success', 'Provider deleted successfully.');
    }
}
