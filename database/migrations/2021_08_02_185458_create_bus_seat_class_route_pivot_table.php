<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusSeatClassRoutePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_seat_class_route', function (Blueprint $table) {
            $table->unsignedBigInteger('route_id');
            $table->foreign('route_id', 'route_id_fk_4516371')->references('id')->on('routes')->onDelete('cascade');
            $table->unsignedBigInteger('bus_seat_class_id');
            $table->foreign('bus_seat_class_id', 'bus_seat_class_id_fk_4516371')->references('id')->on('bus_seat_classes')->onDelete('cascade');
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
        Schema::dropIfExists('bus_seat_class_route_pivot');
    }
}
