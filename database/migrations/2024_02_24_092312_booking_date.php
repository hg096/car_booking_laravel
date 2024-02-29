<?php

use App\Models\BookingDate;
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
        Schema::create('booking_date', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('phone_num');
            $table->string('user_email');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->foreignId('car_id')->constrained('cars');
            $table->foreignId('user_id')->nullable()->constrained('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('booking_date');
    }
};
