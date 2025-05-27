<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('product.index', compact('products'));//
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
        );
    
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
        return redirect()->route('seller.products')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        
        return view('product.show', compact('product'));
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
        $product = Product::find($id);  

        if (!$product) {  
            return redirect()->route('seller.product')->with('error', 'Product not found.');  
        }  

        $product->delete();  

        return redirect()->route('seller.product')->with('success', 'Product deleted successfully.');
    }
}
