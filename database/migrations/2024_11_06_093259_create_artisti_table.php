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
            $table->string('tipo');
            $table->date('nascita')->nullable();
            $table->date('morte')->nullable();
            $table->date('inizio')->nullable();
            $table->date('fine')->nullable();
            $table->string('wikipedia')->nullable();
            $table->timestamps();
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