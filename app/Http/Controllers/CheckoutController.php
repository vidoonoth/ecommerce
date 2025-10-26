<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

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

        $orderId = uniqid(); // Generate order ID once

        // Create a pending checkout record in your database
        $checkout = Checkout::create([
            'user_id' => Auth::id(),
            'order_id' => $orderId,
            'gross_amount' => $total,
            'transaction_status' => 'pending_payment', // Initial status
            'payment_type' => null, // Will be updated by callback
            'transaction_id' => null, // Will be updated by callback
            'status_message' => 'Waiting for payment',
            'json_data' => json_encode($cart), // Store the cart content
        ]);

        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => (int) $total, // Cast to integer
        ];

        $customer_details = [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'customer_id' => Auth::id(),
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
            // Find the existing checkout record
            $checkout = Checkout::where('order_id', $request->order_id)->first();

            if (!$checkout) {
                Log::error('Checkout record not found for order_id: ' . $request->order_id);
                return response()->json(['message' => 'Transaction failed: Order not found'], 404);
            }

            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $checkout->update([
                    'gross_amount' => $request->gross_amount,
                    'transaction_status' => $request->transaction_status,
                    'payment_type' => $request->payment_type,
                    'transaction_id' => $request->transaction_id,
                    'status_message' => $request->status_message,
                    // Ensure json_data is NOT updated here to preserve original cart content
                ]);

                // Attach products to the checkout and reduce stock
                // Retrieve cart content from json_data stored during checkout initiation
                $cart = json_decode($checkout->json_data, true);

                $productSyncData = [];
                foreach ($cart as $id => $item) {
                    $productSyncData[$id] = [
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ];

                    // Reduce product stock
                    $product = Product::find($id);
                    if ($product) {
                        $product->stock -= $item['quantity'];
                        $product->save();
                    } else {
                        Log::warning("Product with ID {$id} not found when trying to reduce stock.");
                    }
                }
                $checkout->products()->sync($productSyncData);

                // Clear cart for the user associated with this order
                session()->forget('cart');

                return response()->json(['message' => 'Transaction successful'], 200);
            } else {
                // Update the checkout record with the non-successful status
                $checkout->update([
                    'transaction_status' => $request->transaction_status,
                    'status_message' => $request->status_message,
                    // Ensure json_data is NOT updated here to preserve original cart content
                ]);
            }
        } else {
            Log::warning('Signature key mismatch for order_id: ' . $request->order_id);
        }
        return response()->json(['message' => 'Transaction failed'], 400);
    }
}
