<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSeatLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seat_layouts', function (Blueprint $table) {
            $table->unsignedBigInteger('bus_id');
            $table->foreign('bus_id', 'bus_fk_4375916')->references('id')->on('buses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seat_layouts', function (Blueprint $table) {
            //
        });
    }
}
