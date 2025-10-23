<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->is_cs ?? false) {
            return redirect()->route('cs.chat');
        }
        $products = Product::latest()->take(10)->get();
        return view('dashboard', compact('products'));
    }
}
