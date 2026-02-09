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
            $table->foreignId('region_id')->nullable()->after('email')->constrained('regions');
            $table->foreignId('province_id')->nullable()->after('region_id')->constrained('provinces');
            $table->foreignId('city_id')->nullable()->after('province_id')->constrained('cities');
            $table->string('street')->nullable()->after('city_id');
            $table->string('civic', 20)->nullable()->after('street');
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
