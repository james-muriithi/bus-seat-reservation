<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenityBusPivotTable extends Migration
{
    public function up()
    {
        Schema::create('amenity_bus', function (Blueprint $table) {
            $table->unsignedBigInteger('bus_id');
            $table->foreign('bus_id', 'bus_id_fk_4309126')->references('id')->on('buses')->onDelete('cascade');
            $table->unsignedBigInteger('amenity_id');
            $table->foreign('amenity_id', 'amenity_id_fk_4309126')->references('id')->on('amenities')->onDelete('cascade');
        });
    }
}
