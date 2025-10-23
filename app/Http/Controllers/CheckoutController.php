<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong. Silakan tambahkan produk terlebih dahulu.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        if ($total < 1) { // Midtrans requires gross_amount >= 1 (or 0.01 depending on currency, but 1 is safer for IDR)
            return redirect()->route('cart.index')->with('error', 'Total belanja harus lebih besar dari Rp 0 untuk melanjutkan pembayaran.');
        }

        // Set your Merchant Server Key
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $transaction_details = [
            'order_id' => uniqid(),
            'gross_amount' => (int) $total, // Cast to integer
        ];

        $customer_details = [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
        ];

        $item_details = [];
        foreach ($cart as $id => $item) {
            $item_details[] = [
                'id' => $id,
                'price' => (int) $item['price'], // Cast to integer
                'quantity' => $item['quantity'],
                'name' => $item['name'],
            ];
        }

        $params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('checkout', compact('snapToken', 'cart', 'total'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $checkout = Checkout::create([
                    'user_id' => Auth::id(),
                    'order_id' => $request->order_id,
                    'gross_amount' => $request->gross_amount,
                    'transaction_status' => $request->transaction_status,
                    'payment_type' => $request->payment_type,
                    'transaction_id' => $request->transaction_id,
                    'status_message' => $request->status_message,
                    'json_data' => json_encode($request->all()),
                ]);

                // Clear cart
                session()->forget('cart');

                return response()->json(['message' => 'Transaction successful'], 200);
            }
        }
        return response()->json(['message' => 'Transaction failed'], 400);
    }
}
