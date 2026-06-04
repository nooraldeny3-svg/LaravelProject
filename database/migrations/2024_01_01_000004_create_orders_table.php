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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('total_price', 10, 2);
            // status can be: pending (new), confirmed (admin approved), cancelled
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->date('travel_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
