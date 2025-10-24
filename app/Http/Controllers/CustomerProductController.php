<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CustomerProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->latest()->paginate(12); // Fetch products with category and brand, 12 per page
        return view('products', compact('products'));
    }

    public function apiIndex(Request $request)
    {
        $products = Product::with(['category', 'brand'])->latest()->paginate(12);
        return Response::json($products);
    }
}
