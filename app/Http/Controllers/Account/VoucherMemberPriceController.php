<?php

namespace App\Http\Controllers;

use App\Models\VoucherMemberPrice;
use App\Models\VoucherProfile;
use App\Models\MemberLevel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class VoucherMemberPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $prices = VoucherMemberPrice::with(['voucherProfile', 'memberLevel'])->get();
        $voucherProfiles = VoucherProfile::all();
        $memberLevels = MemberLevel::all();

        return Inertia::render('VoucherMemberPrice/Index', [
            'prices' => $prices,
            'voucherProfiles' => $voucherProfiles,
            'memberLevels' => $memberLevels,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $voucherProfiles = VoucherProfile::all();
        $memberLevels = MemberLevel::all();

        return Inertia::render('VoucherMemberPrice/Create', [
            'voucherProfiles' => $voucherProfiles,
            'memberLevels' => $memberLevels,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'voucher_profile_id' => 'required|exists:voucher_profiles,id',
            'member_level_id' => 'required|exists:member_levels,id',
            'price_points' => 'required|integer',
        ]);

        VoucherMemberPrice::create($validated);

        return redirect()->route('voucher-member-prices.index')
            ->with('success', 'Voucher Member Price created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        $price = VoucherMemberPrice::with(['voucherProfile', 'memberLevel'])->findOrFail($id);

        return Inertia::render('VoucherMemberPrice/Show', [
            'price' => $price,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): Response
    {
        $price = VoucherMemberPrice::findOrFail($id);
        $voucherProfiles = VoucherProfile::all();
        $memberLevels = MemberLevel::all();

        return Inertia::render('VoucherMemberPrice/Edit', [
            'price' => $price,
            'voucherProfiles' => $voucherProfiles,
            'memberLevels' => $memberLevels,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'voucher_profile_id' => 'required|exists:voucher_profiles,id',
            'member_level_id' => 'required|exists:member_levels,id',
            'price_points' => 'required|integer',
        ]);

        $price = VoucherMemberPrice::findOrFail($id);
        $price->update($validated);

        return redirect()->route('voucher-member-prices.index')
            ->with('success', 'Voucher Member Price updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $price = VoucherMemberPrice::findOrFail($id);
        $price->delete();

        return redirect()->route('voucher-member-prices.index')
            ->with('success', 'Voucher Member Price deleted successfully.');
    }
}
