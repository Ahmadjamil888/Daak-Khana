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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('courier_company_id')->constrained()->onDelete('cascade');
            $table->foreignId('courier_service_id')->constrained()->onDelete('cascade');
            $table->text('pickup_address');
            $table->text('delivery_address');
            $table->json('package_details');
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'picked_up', 'in_transit', 'delivered', 'cancelled'])->default('pending');
            $table->datetime('pickup_date');
            $table->datetime('delivery_date')->nullable();
            $table->text('special_instructions')->nullable();
            $table->json('tracking_updates')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
