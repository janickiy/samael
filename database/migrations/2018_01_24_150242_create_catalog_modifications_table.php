<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogModificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_modifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('model')->index('model')->comment('');
            $table->string('name')->comment('название');
            $table->string('body_type')->comment('тип кузова');
            $table->integer('length')->comment('Длина, мм');
            $table->integer('width')->comment('Ширина, мм');
            $table->integer('height')->comment('Высота, мм');
            $table->integer('wheel_base')->comment('Колесная база, мм');
            $table->integer('front_rut')->comment('Передняя колея колес, мм');
            $table->integer('back_rut')->comment('Задняя колея колес, мм');
            $table->integer('front_overhang')->comment('Задняя колея колес, мм');
            $table->integer('back_overhang')->comment('Задний свес, мм');
            $table->integer('trunk_volume_min')->comment('Минимальный объем багажного отделения, л');
            $table->integer('trunk_volume_max')->comment('Максимальный объем багажного отделения, л');
            $table->integer('tank_volume')->comment('Объем топливного бака, л');
            $table->string('front_brakes')->comment('Передние тормоза (тип, размер)');
            $table->string('back_brakes')->comment('Задние тормоза (тип, размер)');
            $table->string('front_suspension')->comment('Передняя подвеска');
            $table->string('back_suspension')->comment('Задняя подвеска');
            $table->integer('engine_displacement')->comment('Объем двигателя, л');
            $table->integer('engine_displacement_working_value')->comment('Рабочий объем двигателя, см3');
            $table->string('engine_type')->comment('Тип привода');
            $table->string('gearbox')->comment('Коробка передач');
            $table->integer('gears')->comment('Количество передач');
            $table->string('drive')->comment('Тип привода');
            $table->integer('power')->comment('Мощность, л.с.');
            $table->double('consume_city')->comment('Расход топлива в городе, л/100 км');
            $table->double('consume_track')->comment('Расход топлива на трассе, л/100 км');
            $table->double('consume_mixed')->comment('Смешанный расход топлива, л/100 к');
            $table->double('acceleration_100km')->comment('Разгон от 0 до 100 км/ч, сек');
            $table->integer('max_speed')->comment('скорость, км/ч');
            $table->integer('clearance')->comment('Дорожный просвет, мм');
            $table->integer('min_mass')->comment('Минимальная масса, кг');
            $table->integer('max_mass')->comment('Максимальная масса, кг');
            $table->integer('trailer_mass')->comment('Допустимая масса прицепа без тормозов, кг');
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
        Schema::drop('catalog_modifications');
    }
}
