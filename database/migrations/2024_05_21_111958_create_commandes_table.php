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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
             $table->string('statut');
             $table->json('produits');
            $table->decimal('prixTotal', 10, 2); 
            $table->string('prenom');
            $table->string('email');
            $table->string('telephone');
            $table->string('ville');
            $table->string('adresse');
            $table->decimal('prixProduit', 10, 2)->required();
             $table->string('image')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
