<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panier_produits', function (Blueprint $table) {
            $table->id();
            $table->integer('prixTotal');
            $table->integer('quantite');
            $table->timestamps();

            $table->foreignId('panier_id')
                    ->constrained('paniers')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
    
            $table->foreignId('produit_id')
                    ->constrained('produits')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('panier_produits');
    }
};
