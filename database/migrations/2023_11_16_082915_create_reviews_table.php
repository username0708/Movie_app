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
        Schema::create('reviews', function (Blueprint $table) {
            $table->integer('mID')->unsigned();
            $table->integer('id')->unsigned();
            $table->integer('star');
            $table->string('title');
            $table->string('content');
            $table->timestamps();

            $table->foreign('mID')->references('mID')->on('movies')->OnDelete('cascade');
            $table->foreign('id')->references('id')->on('users')->OnDelete('cascade');

            $table->unique(['mID', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
