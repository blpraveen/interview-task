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
        Schema::create('weather', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city')->unique();
            $table->text('desc')->nullable();
            $table->decimal('temp', 8, 2)->nullable();
            $table->decimal('feels_like', 8, 2)->nullable();
            $table->decimal('temp_min', 8, 2)->nullable();
            $table->decimal('temp_max', 8, 2)->nullable();
            $table->integer('pressure')->nullable();
            $table->integer('humidity')->nullable();
            $table->decimal('wind_speed', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather');
    }
};
