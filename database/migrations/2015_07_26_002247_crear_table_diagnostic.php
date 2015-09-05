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
            $table->integer('users_id')->unsigned();
            $table->integer('diseases_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('diagnostics', function (Blueprint $table) {
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
        Schema::table('diagnostics', function (Blueprint $table) {
            $table->dropForeign('diagnostics_users_id_foreign');
            $table->dropForeign('diagnostics_diseases_id_foreign');
        });

        Schema::drop('diagnostics');
    }
}
