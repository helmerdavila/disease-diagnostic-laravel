<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CrearTableRulers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('disease_id')->unsigned();
            $table->integer('symptom_id')->unsigned();
            $table->timestamps();
        });

        //Sentencia de esquema table para las claves foraneas, reemplaza create por table
        Schema::table('rules', function (Blueprint $table) {
            $table->foreign('disease_id')->references('id')->on('diseases')->onDelete('cascade');
            $table->foreign('symptom_id')->references('id')->on('symptoms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rules', function (Blueprint $table) {
            $table->dropForeign('rules_disease_id_foreign');
            $table->dropForeign('rules_symptom_id_foreign');
        });

        Schema::drop('rules');
    }
}
