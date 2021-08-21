<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusSeatClassRoutePriceVariationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('bus_seat_class_route_price_variation', function (Blueprint $table) {
            $table->unsignedBigInteger('route_price_variation_id');
            $table->foreign('route_price_variation_id', 'route_price_variation_id_fk_4690534')->references('id')->on('route_price_variations')->onDelete('cascade');
            $table->unsignedBigInteger('bus_seat_class_id');
            $table->foreign('bus_seat_class_id', 'bus_seat_class_id_fk_4690534')->references('id')->on('bus_seat_classes')->onDelete('cascade');
            $table->decimal('fare', 15, 2)->nullable();
        });
    }
}