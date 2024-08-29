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
        Schema::create('booking_entities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->boolean('status')->default(true);
            $table->timestamp('date');

            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customer_entities');

            $table->bigInteger('seat_id')->unsigned();
            $table->foreign('seat_id')->references('id')->on('seat_entities');

            $table->bigInteger('billboard_id')->unsigned();
            $table->foreign('billboard_id')->references('id')->on('billboard_entities');

            $table->timestamps(1);
            $table->softDeletes('deleted_at', 1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_entities');
    }
};
