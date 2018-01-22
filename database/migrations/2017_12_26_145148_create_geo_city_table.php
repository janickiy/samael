<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_cities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_country')->index('id_country');
            $table->integer('id_region')->index('id_region');
            $table->string('name_ru', 50)->index('name_ru');
            $table->string('name_en', 50)->index('name_en');
            $table->integer('sort')->default(0)->index('sort');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('geo_cities');
    }
}
