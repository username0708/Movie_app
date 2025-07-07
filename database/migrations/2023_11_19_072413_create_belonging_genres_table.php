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
        Schema::create('belonging_genres', function (Blueprint $table) {
            $table->integer('mID')->unsigned();
            $table->integer('gID')->unsigned();
            $table->timestamps();

            $table->foreign('mID')->references('mID')->on('movies')->OnDelete('cascade');
            $table->foreign('gID')->references('gID')->on('genres')->OnDelete('cascade');

            $table->unique(['mID', 'gID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('belonging_genres');
    }
};
