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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('type', ['car', 'suv', 'truck', 'van'])->nullable();
            $table->string('manufacturer');
            $table->string('model');
            $table->smallInteger('year')->nullable();
            $table->string('license')->nullable();
            $table->string('vin')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['A', 'D'])->default('A'); // A - Active, D - Disabled
            $table->timestamps();
        });

        Schema::create('miles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id');
            $table->integer('miles');
            $table->timestamps();
        });

        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->timestamps();
        });

        Schema::create('work', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Oil change, Tire rotation, etc.
            $table->bigInteger('cost'); // In cents $21.85 = 2185
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_history_id');
            $table->foreignId('work_id');
        });

        Schema::create('service_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id');
            $table->foreignId('place_id')->nullable();
            $table->foreignId('mile_id')->nullable();
            $table->bigInteger('total'); // In cents $123.43 = 12343
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
        Schema::dropIfExists('work');
        Schema::dropIfExists('services');
        Schema::dropIfExists('service_history');
        Schema::dropIfExists('miles');
        Schema::dropIfExists('vehicles');
    }
};
