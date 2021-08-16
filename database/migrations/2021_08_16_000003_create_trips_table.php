<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trip_id')->nullable();
            $table->date('travel_date');
            $table->integer('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
