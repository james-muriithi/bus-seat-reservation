<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutePriceVariationsTable extends Migration
{
    public function up()
    {
        Schema::create('route_price_variations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('fare', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
