<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_marks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name_rus')->nullable();
            $table->string('slug')->index('slug');
            $table->string('logo');
            $table->string('annotation');
            $table->text('content');
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
        Schema::drop('catalog_marks');
    }
}
