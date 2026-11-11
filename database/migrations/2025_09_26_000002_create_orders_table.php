<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained('quotations')->onDelete('cascade');
            $table->foreignId('designer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained('users')->onDelete('cascade');
            $table->enum('vendor_role', ['supplier','manufacturer']);
            $table->decimal('amount', 10, 2)->default(0);
            $table->string('status')->default('pending'); // pending, approved, paid, completed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};


