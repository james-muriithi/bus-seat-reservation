<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->foreign('trip_id', 'trip_fk_4632475')->references('id')->on('trips');

            $table->unsignedBigInteger('pickup_point_id')->nullable();
            $table->foreign('pickup_point_id', 'pickup_point_fk_4632475')->references('id')->on('pickup_points');

            $table->unsignedBigInteger('drop_off_point_id')->nullable();
            $table->foreign('drop_off_point_id', 'drop_off_point_fk_4632475')->references('id')->on('drop_off_points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            //
        });
    }
}
