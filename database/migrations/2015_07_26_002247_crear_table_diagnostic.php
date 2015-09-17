<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CrearTableDiagnostic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('disease_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('diagnostics', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('disease_id')->references('id')->on('diseases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diagnostics', function (Blueprint $table) {
            $table->dropForeign('diagnostics_user_id_foreign');
            $table->dropForeign('diagnostics_disease_id_foreign');
        });

        Schema::drop('diagnostics');
    }
}
