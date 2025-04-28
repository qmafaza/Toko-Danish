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
        $userId = Auth::user()->id;
        $productId = $request->input('product_id');

        $cart = Cart::firstOrCreate(
            ['user_id' => $userId],
        );

        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $productId)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            $cartItem = CartItem::create([
                'cart_id'    => $cart->id,
                'product_id' => $productId,
                'quantity'   => 1,
            ]);
        }

        $cart->total_item++;
        $cart->total_price += $cartItem->product->price;
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update_quantity(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::user()->id],
        );

        if ($request->action === 'increment') {
            $cartItem->quantity++;
            $cartItem->save();
            
            $cart->total_item++;
            $cart->total_price += $cartItem->product->price;
            $cart->save();
        } elseif ($request->action === 'decrement') {
            if ($cartItem->quantity <= 1) {
                $cartItem->delete();
            } else {
                $cartItem->quantity--;
                $cartItem->save();
            }

            $cart->total_item--;
            $cart->total_price -= $cartItem->product->price;
            $cart->save();
        }

        return back();
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
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::user()->id],
        );

        $cart_item = CartItem::find($id);

        if (!$cart_item) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        $cart_item->delete();

        $cart->total_item--;
        $cart->total_price -= $cart_item->product->price;
        $cart->save();

        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}
