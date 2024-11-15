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
        Schema::create('edizioni', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('numero');
            $table->string('anno');
            $table->text('luogo');
            $table->text('note')->comment('avvenimenti');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edizioni');
    }
};