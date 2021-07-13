<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('smtp_username')->nullable();
            $table->string('smtp_host')->nullable();
            $table->string('smtp_password')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
