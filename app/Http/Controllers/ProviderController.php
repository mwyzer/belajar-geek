<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::all();
        return response()->json($providers);
    }

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
        ]);

        $provider = Provider::create($validated);
        return response()->json($provider, 201);
    }

    public function show(Provider $provider)
    {
        return response()->json($provider);
    }

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
        ]);

        $provider->update($validated);
        return response()->json($provider);
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();
        return response()->json(['message' => 'Provider deleted']);
    }
}
