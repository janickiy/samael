<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogParameterPackParameterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_parameter_pack_parameter', function (Blueprint $table) {
            $table->integer('id_parameter')->index('id_parameter');
            $table->integer('id_pack')->index('id_pack');
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
        Schema::drop('catalog_parameter_pack_parameter');
    }
}
