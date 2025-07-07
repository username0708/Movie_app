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
        Schema::table('movies', function(Blueprint $table) {
            $table->index('mName');
            $table->index('date');
        });

        Schema::table('belonging_genres', function(Blueprint $table) {
            $table->index('gID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function(Blueprint $table){
            $table->dropIndex('movies_mname_index');
            $table->dropIndex('movies_date_index');
        });

        Schema::table('belonging_genres', function(Blueprint $table){
            $table->dropIndex('belonging_genres_gid_index');
        });
    }
};
