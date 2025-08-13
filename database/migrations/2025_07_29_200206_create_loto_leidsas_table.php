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
        Schema::create('loto_leidsas', function (Blueprint $table) {
            $table->id();
            $table->date('draw_date');
            $table->json('numbers');
            $table->unsignedBigInteger('lottery_id');
            $table->timestamps();
            $table->foreign('lottery_id')->references('id')->on('loterias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loto_leidsas');
    }
};
