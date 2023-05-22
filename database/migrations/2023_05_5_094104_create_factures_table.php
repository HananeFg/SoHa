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
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("serveur_id")->unsigned();
            $table->bigInteger("client_id")->unsigned();
            $table->bigInteger("table_id")->unsigned();
            $table->decimal("total_price")->default(0);
            $table->decimal("total_recieved")->default(0);
            $table->decimal("change")->default(0);
            $table->string("payment_type")->default("cash");
            $table->string("payment_status")->default("paid");
            $table->dateTime('datetime_facture');
            $table->timestamps();
            $table->foreign('user_id')->references("id")
            ->on("users")->onDelete("cascade");
            $table->foreign('serveur_id')->references("id")
            ->on("serveurs")->onDelete("cascade");
            $table->foreign('client_id')->references("id")
            ->on("clients")->onDelete("cascade");
            $table->foreign('table_id')->references("id")
            ->on("tables")->onDelete("cascade");
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
