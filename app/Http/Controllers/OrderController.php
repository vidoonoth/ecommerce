<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Checkout::with('products')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }
}
