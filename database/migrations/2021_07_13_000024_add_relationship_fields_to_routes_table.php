<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRoutesTable extends Migration
{
    public function up()
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->unsignedBigInteger('bus_id');
            $table->foreign('bus_id', 'bus_fk_4309154')->references('id')->on('buses');
        });
    }
}
