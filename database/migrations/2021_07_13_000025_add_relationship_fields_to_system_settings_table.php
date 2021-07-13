<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSystemSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('system_settings', function (Blueprint $table) {
            $table->unsignedBigInteger('default_currency_id');
            $table->foreign('default_currency_id', 'default_currency_fk_4376204')->references('id')->on('currencies');
        });
    }
}
