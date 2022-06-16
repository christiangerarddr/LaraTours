<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingPassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_passengers', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedTinyInteger('booking_id');
            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->unsignedTinyInteger('passenger_id');
            $table->foreign('passenger_id')->references('id')->on('passengers');
            $table->string('special_request');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_passengers');
    }
}
