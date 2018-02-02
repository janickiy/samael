<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogComplectationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_complectations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_model')->index('id_model');
            $table->integer('id_modification')->index('id_modification');
            $table->string('name');
            $table->text('equipment');
            $table->text('pack');
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
        Schema::drop('catalog_complectations');
    }
}