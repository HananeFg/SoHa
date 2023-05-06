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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("serveur_id")->unsigned();
            $table->bigInteger("client_id")->unsigned();
            $table->decimal("total_price")->default(0);
            $table->decimal("total_recieved")->default(0);
            $table->decimal("change")->default(0);
            $table->decimal("payment_type")->default("cash");
            $table->decimal("payment_status")->default("paid");
            $table->timestamps();
            $table->foreign('serveur_id')->references("id")
            ->on("serveurs")->onDelete("cascade");
            $table->foreign('client_id')->references("id")
            ->on("clients")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
