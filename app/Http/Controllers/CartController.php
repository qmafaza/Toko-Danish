<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Auth::user()->cart;
        $cart_items = $cart->products;

        return view('cart.index', compact('cart', 'cart_items'));//
    }

    /**
     * Show the form for creating a new resource.
     */
public function create(Request $request)
{
    $userId = Auth::user()->id; // kalau kamu pakai auth, ambil user id
    $productId = $request->input('product_id'); // ambil product_id dari form POST

    // 1. Cari cart user, kalau belum ada, buat baru
    $cart = Cart::firstOrCreate(
        ['user_id' => $userId],
        ['status' => 'active'] // atau set kolom lain sesuai kebutuhan
    );

        CartItem::create([
        'cart_id'    => $cart->id,
        'product_id' => $productId,
        'quantity'   => 1, // default quantity 1, atau bisa ambil dari request
    ]);

    // 3. (Opsional) Redirect ke halaman cart atau kasih flash message
    return redirect()->route('cart.index')->with('success', 'Product added to cart!');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
                // Kalau cart item model kamu namanya CartItem:
        $cartItem = \App\Models\CartItem::find($id);

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}
