<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Seller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function setup()
    {
        return view('seller.register');
    }

    public function index()
    {
        $seller = DB::table('sellers')->where('user_id', Auth::user()->id)->firstOrFail();

        return view('seller.profile', compact('seller'));
    }

        public function product()
    {
        $seller_id = DB::table('sellers')->where('user_id', Auth::user()->id)->firstOrFail()->id;
        $products = DB::table('products')->where('seller_id', $seller_id)->firstOrFail();

        return view('seller.product', compact('products'));
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
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|unique:sellers,email',
            'seller_address' => 'required|string|max:255',
        ]);

        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
        }

        $validated['user_id'] = Auth::id();

        Seller::create($validated);

        return redirect()->route('seller.profile')->with('success', 'Toko berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
