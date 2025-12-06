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
        Schema::create('mqtt_data', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->default('user_1');
            $table->string('type'); // load, pv, batt
            $table->string('metric'); // voltage, current, power, energy, frequency, pf
            $table->decimal('value', 10, 4);
            $table->timestamps();
            
            $table->index(['user_id', 'type', 'metric']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mqtt_data');
    }
};
