<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('row');
            $table->integer('column');
            $table->string('name')->nullable();
            $table->string('details')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
