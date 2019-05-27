<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone_number');
            $table->string('gender');
            $table->string('img');
            $table->tinyInteger('level')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedInteger('city_id')->index();
            $table->unsignedInteger('street_id')->index();
            $table->date('date_of_birth');
            $table->string('email')->unique();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
