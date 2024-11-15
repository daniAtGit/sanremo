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
        Schema::create('canzoni', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('edizione_id')->nullable();
            $table->string('titolo');
            $table->string('posizione');
            $table->string('posizione_eurovision')->nullable();
            $table->timestamps();

            $table->foreign('edizione_id')->references('id')->on('edizioni')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canzoni');
    }
};