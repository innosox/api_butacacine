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
        Schema::create('customer_entities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->boolean('status')->default(true);
            $table->string('document_number', 20)->unique();

            $table->string('name', 30);
            $table->string('lastname', 30);
            $table->smallInteger('age');
            $table->string('phone_number', 20)->nullable();
            $table->string('email', 100)->nullable();

            $table->timestamps(1);
            $table->softDeletes('deleted_at', 1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_entities');
    }
};
