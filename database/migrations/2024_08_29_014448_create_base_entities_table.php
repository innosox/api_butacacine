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
        Schema::create('base_entities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->boolean('status')->default(true);
            $table->timestamps(1);
            $table->softDeletes('deleted_at', 1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_entities');
    }
};
