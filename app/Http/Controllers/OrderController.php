<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Logika untuk mengambil data history order
        $orders = Auth::user()->orders()->get();


        return view('historyorder', [
            'orders' => $orders
        ]);
    }

    public function ordersum($order_id)
    {
        // Logika untuk mengambil data history order
        $order = Auth::user()->orders()->where('id', $order_id)->first();

        if (!$order) {
            return redirect()->route('history.order')->with('error', 'Order not found');
        }

        $order_items = $order->products()->get();


        return view('summaryorder', compact('order', 'order_items'));
    }


    public function checkout(Request $request)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $user = Auth::user();
        $cart = $user->cart;

        $order = Order::create([
            'user_id' => $user->id,
            'status' => 1,
            'order_date' => now(),
            'total_price' => round($cart->total_price * 1.1 + $request['delivery_package']),
            'total_item' => $cart->total_item,
            'pickup_fee' => $request['delivery_package'],
            'tax' => round($cart->total_price * 0.1),
        ]);

        foreach ($cart->products as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
            ]);

            $product = Product::find($cartItem->product_id);
            $product->stock -= $cartItem->quantity;
            $product->save();
        }

        CartItem::where('cart_id', $cart->id)->delete();

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => round($cart->total_price * 1.1 + $request['delivery_package']),
            ),
            'customer_details' => array(
                'first_name' => "Saudara",
                'last_name' => $user->name,
                'email' => $user->email,
                'phone' => $request['phone'],
            ),
            'redirect_url' => route('history.order')
        );

        $cart->total_price = 0;
        $cart->total_item = 0;
        $cart->save();

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $url = \Midtrans\Snap::getSnapUrl($params);

        return redirect()->away($url);
    }
}
