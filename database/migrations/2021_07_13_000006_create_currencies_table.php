<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency_code');
            $table->string('currency_name');
            $table->string('currency_symbol');
            $table->boolean('status')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
