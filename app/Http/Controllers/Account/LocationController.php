<?php

namespace App\Http\Controllers\Account;

use App\Models\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::when(request()->q, function ($query) {
            $query->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        $locations->appends(['q' => request()->q]);

        return Inertia::render('Account/Locations/Index', [
            'locations' => $locations,
            'filters' => request()->only('q'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Account/Locations/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:locations,name',
            'address' => 'required|string',
            'image' => 'required|mimes:png,jpg|max:2048',
        ]);

        // Upload image
        $image = $request->file('image');
        $imagePath = $image->storeAs('public/locations', $image->hashName());

        // Create location
        Location::create([
            'name' => $request->name,
            'address' => $request->address,
            'image' => $image->hashName(),
        ]);

        return redirect()->route('account.locations.index')->with('success', 'Location created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return response()->json($location);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);

        return Inertia::render('Account/Locations/Edit', [
            'location' => $location,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:locations,name,' . $location->id,
            'address' => 'required|string',
            'image' => 'nullable|mimes:png,jpg|max:2048',
        ]);

        $data = $request->only('name', 'address');

        // Handle image update if provided
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($location->image && Storage::exists('public/locations/' . $location->image)) {
                Storage::delete('public/locations/' . $location->image);
            }

            // Upload new image
            $image = $request->file('image');
            $data['image'] = $image->hashName();
            $image->storeAs('public/locations', $image->hashName());
        }

        $location->update($data);

        return redirect()->route('account.locations.index')->with('success', 'Location updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        // Delete image if exists
        if ($location->image && Storage::exists('public/locations/' . $location->image)) {
            Storage::delete('public/locations/' . $location->image);
        }

        $location->delete();

        return redirect()->route('account.locations.index')->with('success', 'Location deleted successfully!');
    }
}
