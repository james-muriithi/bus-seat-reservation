<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBusesTable extends Migration
{
    public function up()
    {
        Schema::table('buses', function (Blueprint $table) {
            $table->unsignedBigInteger('bus_type_id');
            $table->foreign('bus_type_id', 'bus_type_fk_4309124')->references('id')->on('bus_types');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4309128')->references('id')->on('users');
        });
    }
}
