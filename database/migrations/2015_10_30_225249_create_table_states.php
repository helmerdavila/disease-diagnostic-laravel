<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CreateTableStates extends Migration
{
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        if (Schema::hasTable('states')) {
            DB::table('states')->insert([
                ['name' => 'Amazonas'],
                ['name' => 'Ancash'],
                ['name' => 'Apurimac'],
                ['name' => 'Arequipa'],
                ['name' => 'Ayacucho'],
                ['name' => 'Cajamarca'],
                ['name' => 'Callao'],
                ['name' => 'Cusco'],
                ['name' => 'Huancavelica'],
                ['name' => 'Huanuco'],
                ['name' => 'Ica'],
                ['name' => 'Junin'],
                ['name' => 'La Libertad'],
                ['name' => 'Lambayeque'],
                ['name' => 'Lima'],
                ['name' => 'Loreto'],
                ['name' => 'Madre de Dios'],
                ['name' => 'Moquegua'],
                ['name' => 'Pasco'],
                ['name' => 'Piura'],
                ['name' => 'Puno'],
                ['name' => 'San Martín'],
                ['name' => 'Tacna'],
                ['name' => 'Tumbes'],
                ['name' => 'Ucayali'],
            ]);
        }
    }

    public function down()
    {
        Schema::drop('states');
    }
}
