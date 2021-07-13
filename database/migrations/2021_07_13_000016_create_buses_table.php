<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bus_name');
            $table->string('bus_reg_no');
            $table->integer('max_seats');
            $table->boolean('status')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
