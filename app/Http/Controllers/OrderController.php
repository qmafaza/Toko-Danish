<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kavist\RajaOngkir\RajaOngkir;

class OrderController extends Controller
{
    public function index()
    {
        // Logika untuk mengambil data history order
        // $orders = auth()->user()->orders()->with('items')->get();
        
        return view('historyorder', [
            // 'orders' => $orders
        ]);
    }
}