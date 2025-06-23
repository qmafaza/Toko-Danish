<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\RajaOngkir;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // private $apiKey = (env("API_ONGKIR_KEY"));

    public function index()
    {
        return view('address');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'city' => 'required|integer',
            'province' => 'required|integer',
            'postcode' => 'required|string|max:20',
        ]);

        if (Auth::user()->addresses->isEmpty()) {
            $validatedData['is_primary'] = true;
        } else {
            $validatedData['is_primary'] = false;
        }

        $validatedData['user_id'] = Auth::user()->id; // atau sesuai metode autentikasi kamu

        $address = Address::create($validatedData);

        return redirect()->route('cart.checkout')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }
}
