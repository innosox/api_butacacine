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
        Schema::create('billboard_entities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->boolean('status')->default(true);

            $table->bigInteger('movie_id')->unsigned();
            $table->foreign('movie_id')->references('id')->on('movie_entities');

            $table->timestamp('date');
            $table->time('start_time');
            $table->time('end_time');

            $table->bigInteger('room_id')->unsigned();
            $table->foreign('room_id')->references('id')->on('room_entities');
            $table->timestamps(1);
            $table->softDeletes('deleted_at', 1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billboard_entities');
    }
};
