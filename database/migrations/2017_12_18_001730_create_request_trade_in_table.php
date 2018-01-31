<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTradeInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_trade_ins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('ФИО');
            $table->string('phone')->comment('телефон');
            $table->string('ip')->nullable()->comment('ip');
            $table->string('mark')->comment('марка авто клиента');
            $table->string('model')->comment('модель авто клиента');
            $table->integer('year')->nullable()->comment('год');
            $table->integer('mileage')->comment('пробег');
            $table->integer('trade_in_mark')->index('trade_in_mark')->comment('марка желаемого автомобиля');
            $table->integer('trade_in_model')->index('trade_in_model')->comment('модель желаемого автомобиля');
            $table->integer('trade_in_complectation')->index('trade_in_complectation')->comment('комплектация');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('request_trade_ins');
    }
}
