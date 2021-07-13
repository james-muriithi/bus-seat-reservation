<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDropOffPointsTable extends Migration
{
    public function up()
    {
        Schema::table('drop_off_points', function (Blueprint $table) {
            $table->unsignedBigInteger('route_id');
            $table->foreign('route_id', 'route_fk_4309267')->references('id')->on('routes');
        });
    }
}
