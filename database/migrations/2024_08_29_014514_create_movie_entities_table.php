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
        Schema::create('movie_entities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->boolean('status')->default(true);
            $table->string('name', 100);
            $table->enum('genre', [
                'ACTION', 'ADVENTURE', 'COMEDY', 'DRAMA', 'FANTASY', 'HORROR',
                'MUSICALS', 'MYSTERY', 'ROMANCE', 'SCIENCE_FICTION', 'SPORTS', 'THRILLER', 'WESTERN'
            ]);
            $table->smallInteger('allowed_age');
            $table->smallInteger('length_minutes');

            $table->timestamps(1);
            $table->softDeletes('deleted_at', 1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_entities');
    }
};
