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
        //collego categorie a user (N:N)
        Schema::create('category_user', function (Blueprint $table) {
            $table->id();

            //prendo user
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->cascadeOnDelete();

            //prendo categoria
            $table->foreignId('category_id')
                    ->constrained('categories')
                    ->cascadeOnDelete();

            //associo categorie a user
            $table->unique(['user_id', 'category_id']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_user');
    }
};
