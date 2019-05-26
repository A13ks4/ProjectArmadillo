<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end');
            $table->integer('price');
            $table->integer('city_id_from')->unsigned()->index();
            $table->integer('city_id_to')->unsigned()->index();
            $table->integer('vehicle_id')->unsigned()->index();
            $table->integer('driver_id')->unsigned()->index();
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
        Schema::dropIfExists('plans');
    }
}
