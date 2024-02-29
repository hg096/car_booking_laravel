<?php

use App\Models\Cars;
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
        //
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('brand');
            $table->string('car_size');
            $table->timestamps();
        });

        Cars::create([ 'name' => '차1', 'brand' => 'Hyundai', 'car_size' => 'small_car', ]);
        Cars::create([ 'name' => '차2', 'brand' => 'Hyundai', 'car_size' => 'small_car', ]);
        Cars::create([ 'name' => '차3', 'brand' => 'Hyundai', 'car_size' => 'small_car', ]);
        Cars::create([ 'name' => '차4', 'brand' => 'Kia', 'car_size' => 'small_car', ]);
        Cars::create([ 'name' => '차5', 'brand' => 'Kia', 'car_size' => 'small_car', ]);
        Cars::create([ 'name' => '차6', 'brand' => 'RenaultSamsung', 'car_size' => 'small_car', ]);
        Cars::create([ 'name' => '차7', 'brand' => 'SsangYong', 'car_size' => 'small_car', ]);
        Cars::create([ 'name' => '차8', 'brand' => 'Chevrolet', 'car_size' => 'small_car', ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('cars');
    }
};
