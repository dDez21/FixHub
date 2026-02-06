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
        //collego categorie a tecnici (N:N)
        Schema::create('category_tech', function (Blueprint $table) {
            $table->id();

            //prendo tecnico
            $table->foreignId('tech_id')
                    ->constrained('tech')
                    ->cascadeOnDelete();

            //prendo categoria
            $table->foreignId('category_id')
                    ->constrained('categories')
                    ->cascadeOnDelete();

            //associo categorie a tecnico
            $table->unique(['tech_id', 'category_id']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_tech');
    }
};
