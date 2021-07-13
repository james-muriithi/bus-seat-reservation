<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupPointsTable extends Migration
{
    public function up()
    {
        Schema::create('pickup_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pickup_point');
            $table->time('pickup_time');
            $table->boolean('status')->default(0)->nullable();
            $table->string('landmark')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
