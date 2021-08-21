<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRoutePriceVariationsTable extends Migration
{
    public function up()
    {
        Schema::table('route_price_variations', function (Blueprint $table) {
            $table->unsignedBigInteger('pickup_point_id');
            $table->foreign('pickup_point_id', 'pickup_point_fk_4690521')->references('id')->on('pickup_points');
            $table->unsignedBigInteger('drop_point_id');
            $table->foreign('drop_point_id', 'drop_point_fk_4690522')->references('id')->on('drop_off_points');
            $table->unsignedBigInteger('route_id');
            $table->foreign('route_id', 'route_fk_4690523')->references('id')->on('routes');
        });
    }
}
