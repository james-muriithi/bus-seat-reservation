<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusBusSeatClassPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_bus_seat_class', function (Blueprint $table) {
            $table->unsignedBigInteger('bus_id');
            $table->foreign('bus_id', 'bus_id_fk_4515787')->references('id')->on('buses')->onDelete('cascade');
            $table->unsignedBigInteger('bus_seat_class_id');
            $table->foreign('bus_seat_class_id', 'bus_seat_class_id_fk_4515787')->references('id')->on('bus_seat_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_bus_seat_class_pivot');
    }
}
