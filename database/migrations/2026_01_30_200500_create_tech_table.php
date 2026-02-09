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
        Schema::create('tech', function (Blueprint $table) {
            $table->id();
            
            //collego tech a utente tech (1:1)
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->cascadeOnDelete()
                    ->unique();

            //collego tech a centro (N:1)
            $table->foreignId('center_id')
                    ->nullable()
                    ->constrained('centers')
                    ->nullOnDelete();

            $table->date('birth_date');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tech');
    }
};
