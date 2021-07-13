<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSeatsTable extends Migration
{
    public function up()
    {
        Schema::table('seats', function (Blueprint $table) {
            $table->unsignedBigInteger('bus_id');
            $table->foreign('bus_id', 'bus_fk_4375915')->references('id')->on('buses');
        });
    }
}
