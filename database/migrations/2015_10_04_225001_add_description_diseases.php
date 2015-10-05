<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDescriptionDiseases extends Migration
{
    public function up()
    {
        Schema::table('diseases', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name_c');
        });
    }

    public function down()
    {
        Schema::table('diseases', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
