<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('bus_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('bus_quality', 10, 2);
            $table->decimal('punctuality', 10, 2)->nullable();
            $table->decimal('staff_behaviour', 10, 2)->nullable();
            $table->longText('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
