<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->string('brand');
            $table->string('model');
            $table->year('year');

            $table->enum('transmission', ['Automatic', 'Manual']);
            $table->enum('fuel_type', ['Gasoline', 'Diesel']);
            $table->enum('car_type', ['Sedan','SUV','Hatchback','Van','Pickup','MPV',]);
            $table->integer('seats');

            $table->decimal('price_per_day', 10, 2);

            // RFID system
            $table->enum('rfid_type', ['None', 'Autosweep', 'Easytrip', 'Both'])
                ->default('None');

            $table->boolean('is_available')->default(true);
            $table->boolean('is_featured')->default(false);

            $table->text('description')->nullable();

            // Indexes for fast filtering
            $table->index('transmission');
            $table->index('fuel_type');
            $table->index('rfid_type');
            $table->index('price_per_day');
            $table->index('seats');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
