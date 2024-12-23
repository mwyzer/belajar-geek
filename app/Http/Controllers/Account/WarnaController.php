<?php

namespace App\Http\Controllers\Account;

use App\Models\Warna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class WarnaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get warnas
        $warnas = Warna::when(request()->q, function($warnas) {
            $warnas = $warnas->where('name', 'like', '%'. request()->q . '%');
        })->latest()->paginate(5);

        //append query string to pagination links
        $warnas->appends(['q' => request()->q]);

        //render with inertia
        return inertia('Account/Warnas/Index', [
            'warnas' => $warnas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //render with inertia
        return inertia('Account/Warnas/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Validate request
         */
        $request->validate([
            'name'      => 'required',
            'image'     => 'required|mimes:png,jpg',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/warnas', $image->hashName());

        //create warna
        $warna = Warna::create([
            'name'  => $request->name,
            'image' => $image->hashName()
        ]);

        //redirect
        return redirect()->route('account.warnas.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get warna
        $warna = Warna::findOrFail($id);

        //render with inertia
        return inertia('Account/Warnas/Edit', [
            'warna'          => $warna,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warna $warna)
    {
        /**
         * validate request
         */
        $request->validate([
            'name'      => 'required',
        ]);

        //check image update
        if ($request->file('image')) {

            //remove old image
            Storage::disk('local')->delete('public/warnas/'.basename($warna->image));
        
            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/warnas', $image->hashName());

            //update warna with new image
            $warna->update([
                'image'=> $image->hashName(),
                'name' => $request->name,
            ]);

        }

        //update warna without image
        $warna->update([
            'name'          => $request->name,
        ]);

        //redirect
        return redirect()->route('account.warnas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find warna by ID
        $warna = Warna::findOrFail($id);

        //remove image from server
        Storage::disk('local')->delete('public/warnas/'.basename($warna->image));

        //delete warna
        $warna->delete();

        //redirect
        return redirect()->route('account.warnas.index');
    }
}