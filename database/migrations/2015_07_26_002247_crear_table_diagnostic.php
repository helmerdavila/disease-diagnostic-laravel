<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTableDiagnostic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostic', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->integer('diseases_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('diagnostic', function(Blueprint $table){
           $table->foreign('users_id')->references('id')->on('users');
           $table->foreign('diseases_id')->references('id')->on('diseases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diagnostic', function(Blueprint $table){
            $table->dropForeign('diagnostic_users_id_foreign');
            $table->dropForeign('diagnostic_diseases_id_foreign');
        });

        Schema::drop('diagnostic');
    }
}
