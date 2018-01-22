<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarMarksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_marks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('id_car_type')->index('id_car_type');
			$table->string('name_rus')->nullable();
            $table->string('slug')->index('slug');
            $table->string('logo');
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
		Schema::drop('car_marks');
	}

}
