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
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->foreignId('region_id')->nullable()->constrained('regions')->nullOnDelete();
            $table->foreignId('province_id')->nullable()->constrained('provinces')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->string('street')->nullable();
            $table->string('civic', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centers');
    }
};
