<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
