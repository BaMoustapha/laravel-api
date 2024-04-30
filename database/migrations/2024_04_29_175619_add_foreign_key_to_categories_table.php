<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::table('categories', function (Blueprint $table) {
        //     // Ajoutez la colonne de la clé étrangère
        //     $table->unsignedBigInteger('shop_id');

        //     // Ajoutez la contrainte de clé étrangère
        //     $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */

};
