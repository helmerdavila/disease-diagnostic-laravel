<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDescriptionSymptoms extends Migration
{
    public function up()
    {
        Schema::table('symptoms', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name');
        });
    }

    public function down()
    {
        Schema::table('symptoms', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
