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
        Schema::create('facture_payment', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("facture_id")->unsigned();
            $table->bigInteger("payment_id")->unsigned();
            $table->string("payment_type")->default("cash");
            $table->string("payment_status")->default("paid");
            $table->decimal('montant');
            $table->foreign('facture_id')->references("id")
            ->on("factures")->onDelete("cascade");
            $table->foreign('payment_id')->references("id")
            ->on("payments")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facture_payment');
    }
};
