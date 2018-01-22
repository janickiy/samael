<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarModificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_modifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_car_model')->index('id_car_model');
            $table->string('name');
            $table->string('body_type');
            $table->integer('year_begin');
            $table->integer('year_end');
            $table->integer('id_car_type')->index('id_car_type');
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
		Schema::drop('car_modifications');
	}

}
