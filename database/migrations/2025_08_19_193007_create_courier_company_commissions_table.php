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
        Schema::create('courier_company_commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courier_company_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->decimal('commission_amount', 10, 2); // 5% of booking value
            $table->decimal('booking_amount', 10, 2); // Original booking amount for reference
            $table->enum('status', ['pending', 'paid', 'overdue'])->default('pending');
            $table->timestamp('due_date'); // 10 days from commission creation
            $table->timestamp('paid_at')->nullable();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->json('payment_metadata')->nullable();
            $table->timestamps();
            
            $table->index(['courier_company_id', 'status']);
            $table->index(['due_date', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courier_company_commissions');
    }
};
