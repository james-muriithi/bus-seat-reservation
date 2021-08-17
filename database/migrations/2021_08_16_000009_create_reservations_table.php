<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref')->nullable()->unique("reservation ref");
            $table->date('travel_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
