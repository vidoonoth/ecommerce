<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function index()
    {
        return view('cart');
    }

    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart');
        if ($request->quantity == 0) {
            unset($cart[$product->id]);
        } else {
            $cart[$product->id]['quantity'] = $request->quantity;
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Cart updated successfully');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart');
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Product removed from cart successfully');
    }
}
