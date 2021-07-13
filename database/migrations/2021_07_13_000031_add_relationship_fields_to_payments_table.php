<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->foreign('payment_method_id', 'payment_method_fk_4376314')->references('id')->on('payment_methods');
        });
    }
}
