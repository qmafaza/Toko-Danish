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
        // Find the cart item or fail if not found
        $cartItem = CartItem::findOrFail($id);
        // Get or create the cart for the authenticated user
        $cart = Cart::firstOrCreate(['user_id' => Auth::user()->id]);

        // Action to either increment or decrement the quantity
        if ($request->action === 'increment') {
            // Increment quantity
            $cartItem->quantity++;
            $cartItem->save();

            // Update total items and price in the cart
            $cart->total_item++;
            $cart->total_price += $cartItem->product->price;
            $cart->save();
        } elseif ($request->action === 'decrement') {
            if ($cartItem->quantity > 1) {
                // Decrement only if quantity is greater than 1
                $cartItem->quantity--;
                $cartItem->save();

                // Update total items and price in the cart
                $cart->total_item--;
                $cart->total_price -= $cartItem->product->price;
                $cart->save();
            } else {
                // If the quantity is 1, delete the cart item
                $cart->total_item--; // Adjust the total items in the cart before deleting
                $cart->total_price -= $cartItem->product->price; // Adjust the price before deleting
                $cart->save();

                $cartItem->delete();
            }
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
        $cart = Cart::firstOrCreate(['user_id' => Auth::user()->id]);

        $cart_item = CartItem::with('product')->find($id);

        if (!$cart_item) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        $quantity = $cart_item->quantity; // Assuming this is the quantity of the cart item
        $price = $cart_item->product->price; // Get the associated product's price

        if (is_null($price) || is_null($quantity)) {
            return redirect()->back()->with('error', 'Item has no valid price or quantity.');
        }

        $cart->total_item -= $quantity; // Adjust total item count
        $cart->total_price -= $price * $quantity; // Adjust total price
        $cart->save(); // Save updated cart

        // Delete the cart item
        $cart_item->delete(); // Remove cart item from database

        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}

