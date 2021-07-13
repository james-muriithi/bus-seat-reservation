<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDropOffPointsTable extends Migration
{
    public function up()
    {
        Schema::create('drop_off_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('drop_off_point');
            $table->time('drop_time');
            $table->string('landmark')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
