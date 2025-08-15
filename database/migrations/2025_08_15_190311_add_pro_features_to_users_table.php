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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_pro')->default(false);
            $table->timestamp('pro_expires_at')->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->decimal('wallet_balance', 10, 2)->default(0);
            $table->json('pro_features')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_pro', 'pro_expires_at', 'stripe_customer_id', 'wallet_balance', 'pro_features']);
        });
    }
};
