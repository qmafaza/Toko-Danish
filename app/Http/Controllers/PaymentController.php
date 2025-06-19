<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;

class PaymentController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $cart = Auth::user()->cart;

        // Jika cart kosong, kembalikan ke halaman cart
        if (!$cart || $cart->total_price <= 0) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Hitung tax (contoh: 10%)
        $tax = $cart->total_price * 0.1;
        $total = $cart->total_price + $tax;

        // Simpan ke session
        session([
            'subtotal' => $cart->total_price,
            'tax' => $tax,
            'total' => $total
        ]);
        $subtotal = session('subtotal', 0);
        $tax = session('tax', 0);
        $total = session('total', 0);

        $addresses = Auth::user()->addresses;

        return view('cart.payment', compact('subtotal', 'tax', 'total', 'addresses'));
    }


    public function processpayment()
    {
        return view('historyorder');
    }

    public function summaryorder()
    {
        return view('summaryorder');
    }
}
