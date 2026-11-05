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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('quantite');
            $table->date('dateMaj');

            // Les 3 relations du MCD :
            $table->foreignId('entreprise_cliente_id')->constrained('entreprise_clientes')->onDelete('cascade'); // Relation "louer"
            $table->foreignId('entrepot_id')->constrained('entrepots')->onDelete('cascade'); // Relation "contenir" (Entrepôt)
            $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade'); // Relation "contenir" (Produit)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
