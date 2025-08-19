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
        Schema::table('courier_companies', function (Blueprint $table) {
            if (!Schema::hasColumn('courier_companies', 'is_commission_restricted')) {
                $table->boolean('is_commission_restricted')->default(false);
            }
            if (!Schema::hasColumn('courier_companies', 'commission_restricted_at')) {
                $table->timestamp('commission_restricted_at')->nullable();
            }
            if (!Schema::hasColumn('courier_companies', 'total_commission_due')) {
                $table->decimal('total_commission_due', 10, 2)->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courier_companies', function (Blueprint $table) {
            $table->dropColumn([
                'is_commission_restricted',
                'commission_restricted_at', 
                'total_commission_due'
            ]);
        });
    }
};
