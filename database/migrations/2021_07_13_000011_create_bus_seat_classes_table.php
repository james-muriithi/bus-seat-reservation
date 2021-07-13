<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusSeatClassesTable extends Migration
{
    public function up()
    {
        Schema::create('bus_seat_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('color');
            $table->integer('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
