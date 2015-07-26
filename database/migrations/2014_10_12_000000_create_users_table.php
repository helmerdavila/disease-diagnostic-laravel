<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /*
     * string = varchar en la BD, el número indica la longitud del campo
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->boolean('gender')->default(1);
            $table->date('birthday');
            $table->string('phone')->nullable();
            $table->string('mobil')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
