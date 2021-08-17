<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationSeatPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_seat', function (Blueprint $table) {
            $table->unsignedBigInteger('seat_id');
            $table->foreign('seat_id', 'seat_id_fk_4376001')->references('id')->on('seats')->onDelete('cascade');

            $table->unsignedBigInteger('reservation_id');
            $table->foreign('reservation_id', 'reservation_id_fk_4632529')->references('id')->on('reservations')->onDelete('cascade');

            $table->unsignedBigInteger('passenger_id');
            $table->foreign('passenger_id', 'passenger_id_fk_4632529')->references('id')->on('passengers')->onDelete('cascade');

            $table->decimal("amount_paid", 10, 2)->nullable();
            $table->string("ticket_number")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_seat_pivot');
    }
}
