<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusTypesTable extends Migration
{
    public function up()
    {
        Schema::create('bus_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bus_type');
            $table->boolean('status')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
