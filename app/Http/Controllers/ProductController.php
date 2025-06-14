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
        if (request('reset') == 'true') {
            return redirect()->route('product.index');
        }

        // apply filters
        $productsQuery = Product::latest();

        if (request('query')) {
            $searchTerm = '%' . request('query') . '%';
            $productsQuery->where(function($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm);
            });
        }

        if (request('categories')) {
            $categories = request('categories');
            $productsQuery->whereIn('category_id', $categories);
        }

        $products = $productsQuery->get();
        $categories = Category::all();

        // pass current filters back to view if needed
        return view('product.index', compact('products', 'categories'));
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
