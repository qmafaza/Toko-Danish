<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        $products = Product::where('seller_id', $seller->id)->get();

        return view('seller.profile', compact('seller', 'products'));
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'product_image' => 'nullable|image', // max 2MB
        ]);

        $category = Category::find($validated['category_id']);
        $categoryName = strtolower($category->name);
    
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Safe unique filename
            
            // Create a folder for the category inside public/image
            $folderPath = public_path("image/{$categoryName}");
            
            // Make sure the folder exists
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true); // Create directory if not exists
            }

            // Move the image to the category-specific folder
            $image->move($folderPath, $imageName); 

            // Store the image name relative to the public directory
            $validated['image'] = "{$categoryName}/" . $imageName;
        }

        $seller = Seller::firstOrCreate(
            ['user_id' => Auth::user()->id],
        )->id;
    
        // 3. Create the product
        Product::create([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null, // optional if no image uploaded
            'seller_id' => $seller, // assuming you have seller authentication
        ]);
    
        // 4. Redirect or return response
        return redirect()->route('seller.product')
            ->with('success', 'Product created successfully!');
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
