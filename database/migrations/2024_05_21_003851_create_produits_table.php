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
        // if (!Schema::hasTable('produits')) {
            Schema::create('produits', function (Blueprint $table) {
                $table->id();
                $table->string('nom')->required();
                $table->string('image')->required();
                $table->text('description')->required();
                $table->decimal('prix', 8, 2)->required();
                $table->integer('quantite')->default(1)->required();
                $table->unsignedBigInteger('categorie_id')->nullable();
                $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('set null');
                $table->timestamps();
            });
        // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
