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
        Schema::create('courier_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courier_company_id')->constrained()->onDelete('cascade');
            $table->string('service_name');
            $table->text('description');
            $table->enum('service_type', ['same_day', 'next_day', 'express', 'standard', 'international', 'cod']);
            $table->decimal('price', 10, 2);
            $table->string('delivery_time');
            $table->decimal('max_weight', 8, 2);
            $table->json('package_types');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courier_services');
    }
};
