<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeoCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ru', 50)->index('name_ru');
            $table->string('name_en', 50)->index('name_en');
            $table->string('code', 5)->index('code');
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
        Schema::drop('geo_countries');
    }
}
