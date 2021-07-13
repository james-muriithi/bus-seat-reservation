<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReservationsTable extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedBigInteger('passenger_id');
            $table->foreign('passenger_id', 'passenger_fk_4375850')->references('id')->on('passengers');
            $table->unsignedBigInteger('route_id')->nullable();
            $table->foreign('route_id', 'route_fk_4375851')->references('id')->on('routes');
            $table->unsignedBigInteger('pickup_point_id');
            $table->foreign('pickup_point_id', 'pickup_point_fk_4375852')->references('id')->on('pickup_points');
        });
    }
}
