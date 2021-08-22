<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusSeatClassTripPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_seat_class_trip', function (Blueprint $table) {
            $table->unsignedBigInteger('trip_id');
            $table->foreign('trip_id', 'trip_id_fk_4516371')->references('id')->on('trips')->onDelete('cascade');
            $table->unsignedBigInteger('bus_seat_class_id');
            $table->foreign('bus_seat_class_id', 'bus_seat_class_id_fk_4516372')->references('id')->on('bus_seat_classes')->onDelete('cascade');
            $table->decimal('fare', 15, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_seat_class_trip_pivot');
    }
}
