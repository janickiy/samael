<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_car_mark')->index('id_car_mark');
            $table->string('name')->index('name');
            $table->string('name_rus')->nullable();
            $table->string('slug')->index('slug');
            $table->string('image')->index('slug');
            $table->boolean('published')->default(1);
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
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
        Schema::drop('catalog_models');
    }
}
