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
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("facture_id")->unsigned();
            $table->bigInteger("produit_id")->unsigned();
            $table->integer("quantity");
            $table->decimal("unit_price");
            $table->decimal("montant");
            $table->timestamps();
            $table->foreign('facture_id')->references("id")
            ->on("factures")->onDelete("cascade");
            $table->foreign('produit_id')->references("id")
            ->on("menus")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
