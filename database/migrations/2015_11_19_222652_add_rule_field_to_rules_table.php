<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRuleFieldToRulesTable extends Migration
{
    public function up()
    {
        Schema::table('rules', function (Blueprint $table) {
            $table->integer('number')->unsigned()->after('id');
        });
    }

    public function down()
    {
        Schema::table('rules', function (Blueprint $table) {
            $table->dropColumn('number');
        });
    }
}
