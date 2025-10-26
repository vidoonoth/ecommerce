<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Checkout::with(['user', 'products'])->orderBy('created_at', 'desc')->get();
        return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Checkout::with('user', 'products')->findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    // Add methods for updating order status, deleting orders, etc. as needed
}
