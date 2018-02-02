<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogParameterComplectationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_parameter_complectation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_complectation')->index('id_complectation');
            $table->integer('id_parameter')->index('id_parameter');
            $table->integer('price')->index('price');
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
        Schema::drop('catalog_parameter_complectation');
    }
}
