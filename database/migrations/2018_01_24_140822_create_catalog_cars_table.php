<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_cars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('model')->index('model');
            $table->boolean('new');
            $table->text('annotation');
            $table->text('content');
            $table->string('meta_title');
            $table->text('meta_keywords');
            $table->text('meta_description');
            $table->boolean('published');
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
        Schema::drop('catalog_cars');
    }
}
