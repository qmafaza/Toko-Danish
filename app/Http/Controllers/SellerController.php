<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Seller;
use App\Models\Product;

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
        $seller = Seller::with('products.category') // Eager load products with their categories  
                        ->where('user_id', Auth::user()->id)  
                        ->firstOrFail();  

        $products = $seller->products;  

        return view('seller.product', compact('products'));  
    }  


    /**
     * Show the form for creating a new resource.
     */ // Jangan lupa import ini kalau pakai Auth

     public function create_product(Request $request)
     {
         // Validasi data input
         $request->validate([
             'name' => 'required|string|max:255',
             'category_id' => 'required',
             'price' => 'required|numeric',
             'stock' => 'required|integer',
             'description' => 'nullable|string',
             'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
 
         // Ambil user yang login
         $user = Auth::user();
 
         // Cari seller_id berdasarkan user_id
         $seller = Seller::where('user_id', $user->id)->first();
 
         if (!$seller) {
             return redirect(route("seller.product"))->with('error', 'Seller not found for this user.');
         }
 
         // Upload image kalau ada
         $imagePath = null;
         if ($request->hasFile('product_image')) {
             $imagePath = $request->file('product_image')->store('product_images', 'public');
         }
 
         // Simpan produk ke database
         $product = new Product();
         $product->seller_id = $seller->id; // <- ini tambahan seller_id
         $product->name = $request->name;
         $product->category_id = $request->category_id;
         $product->price = $request->price;
         $product->stock = $request->stock;
         $product->description = $request->description;
         $product->image = $imagePath;
         $product->save();
 
         // Redirect atau response
         return redirect(route("seller.product"))->with('success', 'Product successfully created!');
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
