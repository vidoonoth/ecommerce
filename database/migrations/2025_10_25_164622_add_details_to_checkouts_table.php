<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->string('order_id')->unique();
            $table->decimal('gross_amount', 10, 2);
            $table->string('transaction_status')->default('pending');
            $table->string('payment_type')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status_message')->nullable();
            $table->json('json_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropColumn([
                'order_id',
                'gross_amount',
                'transaction_status',
                'payment_type',
                'transaction_id',
                'status_message',
                'json_data',
            ]);
        });
    }
};
