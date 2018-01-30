<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogPacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_packs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_modification')->index('id_modification');
            $table->integer('id_complectation')->index('id_complectation');
            $table->integer('price')->comment('Цена');
            $table->integer('prev_price')->comment('Старая цена');
            $table->boolean('best_price')->comment('Лучшая цена');
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
        Schema::drop('catalog_packs');
    }
}
