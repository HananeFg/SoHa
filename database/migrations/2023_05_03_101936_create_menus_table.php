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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("slug");
            $table->decimal("unit_price", 8, 2)->default(00.00);
            $table->decimal("TTC_price", 8, 2)->default(00.00);
            $table->decimal("TVA", 8, 2)->default(0.2);
            $table->string("image");
            $table->bigInteger("category_id")->unsigned();
            $table->timestamps();
            $table->foreign('category_id')->references("id")
            ->on("categories")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
