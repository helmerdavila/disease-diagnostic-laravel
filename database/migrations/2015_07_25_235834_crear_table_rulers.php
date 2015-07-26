<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTableRulers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rulers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('diseases_id')->unsigned();
            $table->integer('symptoms_id')->unsigned();
            $table->timestamps();
        });

        //Sentencia de esquema table para las claves foraneas, reemplaza create por table
        Schema::table('rulers', function(Blueprint $table){
            $table->foreign('diseases_id')->references('id')->on('diseases');
            $table->foreign('symptoms_id')->references('id')->on('symptoms');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rulers', function(Blueprint $table){
            $table->dropForeign('rulers_diseases_id_foreign');
            $table->dropForeign('rulers_symptoms_id_foreign');
        });

        Schema::drop('rulers');
    }
}
