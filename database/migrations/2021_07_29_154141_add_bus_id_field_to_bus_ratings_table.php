<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusIdFieldToBusRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bus_ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('bus_id')->nullable();
            $table->foreign('bus_id', 'bus_id_fk_4376314')
                ->references('id')
                ->on('buses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bus_ratings', function (Blueprint $table) {
            //
        });
    }
}
