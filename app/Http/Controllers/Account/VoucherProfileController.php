<?php

namespace App\Http\Controllers\Account;

use App\Models\VoucherProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class VoucherProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get voucher profiles with search and pagination
        $voucherProfiles = VoucherProfile::when(request()->q, function ($query) {
            $query->where('profile_name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(5);

        // Append query string to pagination links
        $voucherProfiles->appends(['q' => request()->q]);

        // Render with Inertia
        return inertia('Account/VoucherProfiles/Index', [
            'voucherProfiles' => $voucherProfiles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Account/VoucherProfiles/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'profile_name' => 'required|string|max:255',
            'quota' => 'required|integer',
            'quota_unit' => 'required|string',
            'active_period' => 'required|integer',
            'active_unit' => 'required|string',
            'stock_warning' => 'required|integer',
            'stock_alert' => 'required|integer',
            'is_published' => 'required|boolean',
            'show_stock' => 'required|boolean',
            'max_purchase_per_transaction' => 'required|integer',
            'generate_link' => 'nullable|url',
        ]);

        // Store voucher profile
        VoucherProfile::create($validated);

        return redirect()->route('account.voucher-profiles.index')->with('success', 'Voucher Profile created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  VoucherProfile  $voucherProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(VoucherProfile $voucherProfile)
    {
        return inertia('Account/VoucherProfiles/Edit', [
            'voucherProfile' => $voucherProfile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  VoucherProfile  $voucherProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VoucherProfile $voucherProfile)
    {
        // Validate request
        $validated = $request->validate([
            'profile_name' => 'required|string|max:255',
            'quota' => 'required|integer',
            'quota_unit' => 'required|string',
            'active_period' => 'required|integer',
            'active_unit' => 'required|string',
            'stock_warning' => 'required|integer',
            'stock_alert' => 'required|integer',
            'is_published' => 'required|boolean',
            'show_stock' => 'required|boolean',
            'max_purchase_per_transaction' => 'required|integer',
            'generate_link' => 'nullable|url',
        ]);

        // Update voucher profile
        $voucherProfile->update($validated);

        return redirect()->route('account.voucher-profiles.index')->with('success', 'Voucher Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  VoucherProfile  $voucherProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoucherProfile $voucherProfile)
    {
        // Delete voucher profile
        $voucherProfile->delete();

        return redirect()->route('account.voucher-profiles.index')->with('success', 'Voucher Profile deleted successfully.');
    }
}
