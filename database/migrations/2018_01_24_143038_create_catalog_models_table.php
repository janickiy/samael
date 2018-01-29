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
            $table->integer('id_car_mark')->index('id_car_mark')->comment('id марки');
            $table->string('name')->index('name')->comment('название');
            $table->string('name_rus')->nullable()->comment('название кирилицей');
            $table->string('slug')->index('slug')->comment('url');
            $table->text('annotation')->nullable()->comment('аннотация');
            $table->text('content')->nullable()->comment('Контент');
            $table->text('parametersContent')->nullable()->comment('Текст для вкладки характеристик');
            $table->text('galleryContent')->nullable()->comment('Текст для вкладки галлерея');
            $table->string('image')->comment('логотип');
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