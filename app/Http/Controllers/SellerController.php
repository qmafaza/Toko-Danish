<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\Seller;
use App\Models\Product;
use App\Models\ProductRating;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


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


    public function product(Request $request)
    {
    $seller = Seller::where('user_id', Auth::user()->id)->firstOrFail();
    
    // Ambil parameter pencarian dan filter
    $search = $request->input('search');
    $categoryFilter = $request->input('categories', []);
    $reset = $request->input('reset');
    
    // Jika tombol reset diklik
    if ($reset == 'true') {
        return redirect()->route('seller.product');
    }
    
    // Query dasar untuk produk milik seller
    $query = Product::where('seller_id', $seller->id)
        ->with('category'); // Eager load category
    
    // Tambahkan kondisi pencarian jika ada
    if ($search) {
        $query->where('name', 'like', '%' . $search . '%');
    }
    
    // Tambahkan filter kategori jika dipilih
    if (!empty($categoryFilter)) {
        $query->whereIn('category_id', $categoryFilter);
    }
    
    // Paginasi dengan 5 item per halaman
    $products = $query->paginate(5)->withQueryString();
    $categories = Category::all();

    return view('seller.product', compact('products', 'categories', 'search', 'categoryFilter'));
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
             'product_image' => 'nullable|image|max:2048', // max 2MB
             'weight' => 'required|numeric|min:0', // Tambahkan validasi untuk berat
         ]);

         if ($request->hasFile('product_image')) {
             $image = $request->file('product_image');
             $imageName = time() . '_' . $image->getClientOriginalName();
             $category = Category::find($validated['category_id']);
             $folder = "image/" . strtolower($category->name); // Folder berdasarkan nama kategori

             // Simpan ke GCS
             $path = $image->storeAs($folder, $imageName, 'gcs');

             // Jika visibility = 'private', sebaiknya generate signed URL untuk akses
             $validated['image'] = Storage::disk('gcs')->url($path);
             // Atau kalau mau akses terbatas: generateTemporaryUrl
             // $validated['image'] = Storage::disk('gcs')->temporaryUrl($path, now()->addMinutes(30));
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
            'weight' => $validated['weight'], // ditambahkan
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
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
    public function editProduct(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('seller.editproduct', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|numeric|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Sesuaikan dengan create
        ]);

        $product = Product::findOrFail($id);

        // Handle image upload jika ada
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $category = Category::find($validated['category_id']);
            $folder = "image/" . strtolower($category->name);

            // Upload ke GCS
            $path = $image->storeAs($folder, $imageName, 'gcs');
            $imageUrl = Storage::disk('gcs')->url($path);

            $validated['image'] = $imageUrl;
        }

        $product->update($validated);

        return redirect()->route('seller.product')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_profile(Request $request)
    {
        $user = Auth::user();
        $seller = Seller::where('user_id', $user->id);

        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'seller_address' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'contact_number' => 'required|string',
        ]);

        // Update user data
        $seller->update($validated);

        return back()->with('success', 'Profile updated successfully!');
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

        ProductRating::where("product_id",$product->id)->delete();

        $product->delete();

        return redirect()->route('seller.product')->with('success', 'Product deleted successfully.');
    }
}
