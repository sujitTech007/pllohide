<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('stripe_payment_intent')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 10)->default('usd');
            $table->string('status')->default('pending'); // pending, succeeded, failed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_payments');
    }
};


