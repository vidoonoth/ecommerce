<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkout extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'gross_amount',
        'transaction_status',
        'payment_type',
        'transaction_id',
        'status_message',
        'json_data',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'checkout_product')->withPivot('quantity', 'price');
    }
}
