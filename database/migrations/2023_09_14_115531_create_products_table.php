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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('unit_price');
            $table->integer('quantity');
            $table->enum('condition', ['Bon', 'Tres bon', 'Mauvais', 'Usé']);
            $table->enum('state', ['en attente', 'approuvé', 'desactivée', 'vendue']);
            $table->json('images_url');

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('cat_id')->constrained('categories');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
