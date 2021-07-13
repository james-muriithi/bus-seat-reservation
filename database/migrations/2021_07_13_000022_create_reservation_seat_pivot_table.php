<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationSeatPivotTable extends Migration
{
    public function up()
    {
        Schema::create('reservation_seat', function (Blueprint $table) {
            $table->unsignedBigInteger('reservation_id');
            $table->foreign('reservation_id', 'reservation_id_fk_4376001')->references('id')->on('reservations')->onDelete('cascade');
            $table->unsignedBigInteger('seat_id');
            $table->foreign('seat_id', 'seat_id_fk_4376001')->references('id')->on('seats')->onDelete('cascade');
        });
    }
}
