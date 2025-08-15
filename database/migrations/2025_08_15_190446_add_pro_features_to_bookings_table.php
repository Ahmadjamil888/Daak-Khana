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
        Schema::table('bookings', function (Blueprint $table) {
            $table->boolean('is_pro_booking')->default(false);
            $table->foreignId('assigned_courier_id')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('real_time_tracking_enabled')->default(false);
            $table->json('pro_features')->nullable(); // real_time_tracking, priority_support, etc.
            $table->decimal('pro_fee', 8, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['assigned_courier_id']);
            $table->dropColumn(['is_pro_booking', 'assigned_courier_id', 'real_time_tracking_enabled', 'pro_features', 'pro_fee']);
        });
    }
};
