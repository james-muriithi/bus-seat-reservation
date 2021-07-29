<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRatedByFieldToBusRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bus_ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('rated_by_id');
            $table->foreign('rated_by_id', 'rated_by_fk_4376314')
                ->references('id')
                ->on('passengers');
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
