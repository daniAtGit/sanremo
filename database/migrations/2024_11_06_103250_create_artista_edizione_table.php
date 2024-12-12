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
        Schema::create('artista_edizione', function (Blueprint $table) {
            $table->uuid('artista_id');
            $table->uuid('edizione_id');
            $table->string('ruolo');

            $table->foreign('artista_id')->references('id')->on('artisti')->onDelete('cascade');
            $table->foreign('edizione_id')->references('id')->on('edizioni')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artista_edizione');
    }
};
