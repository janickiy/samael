<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogUsedCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_used_cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mark');
            $table->string('model');
            $table->integer('price');
            $table->integer('year');
            $table->integer('mileage');
            $table->string('gearbox');
            $table->string('drive');
            $table->string('engine_type');
            $table->integer('power');
            $table->string('body');
            $table->string('wheel');
            $table->string('color');
            $table->string('salon');
            $table->string('image');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('description')->nullable();
            $table->text('equipment');
            $table->boolean('special');
            $table->boolean('verified');
            $table->boolean('tradein');
            $table->boolean('published')->default(1);
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
        Schema::drop('catalog_used_cars');
    }
}
