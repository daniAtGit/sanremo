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
        Schema::create('artisti', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome');
            $table->uuid('tipo_id');
            $table->string('wikipedia')->nullable();
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('tipo-artista')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artisti');
    }
};
