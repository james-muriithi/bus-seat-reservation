<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPickupPointsTable extends Migration
{
    public function up()
    {
        Schema::table('pickup_points', function (Blueprint $table) {
            $table->unsignedBigInteger('route_id');
            $table->foreign('route_id', 'route_fk_4309256')->references('id')->on('routes');
        });
    }
}
