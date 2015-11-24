<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Tesis\Models\Role;
use Tesis\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        $this->call(ProductionSeeder::class);
        Model::reguard();
    }
}

class DevelopmentSeeder extends Seeder
{
    public function run()
    {
        $this->call(TruncateTables::class);
        $this->call(StaffSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SymptomSeeder::class);
        $this->call(DiseaseSeeder::class);
        $this->call(DiagnosticSeeder::class);
    }
}

class ProductionSeeder extends Seeder
{
    public function run()
    {
        $this->call(TruncateTables::class);
        $this->call(StaffSeeder::class);
    }
}

class TruncateTables extends Seeder
{
    /**
     * Set foreign key hace que se active y desactive las
     * claves foraneas para poder limpiar la base de
     * datos sin que aparezca ningun tipo de errores
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('diagnostics')->truncate();
        DB::table('diseases')->truncate();
        DB::table('password_resets')->truncate();
        DB::table('permission_role')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_user')->truncate();
        DB::table('roles')->truncate();
        DB::table('rules')->truncate();
        DB::table('symptoms')->truncate();
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

class StaffSeeder extends Seeder
{
    public function run()
    {
        //creamos primero rol administrador y de usuario
        $rolAdmin               = new Role;
        $rolAdmin->name         = 'admin';
        $rolAdmin->display_name = 'Administrador';
        $rolAdmin->description  = 'Usuario con todos los permisos del sistema';
        $rolAdmin->save();

        $rolPaciente               = new Role;
        $rolPaciente->name         = 'paciente';
        $rolPaciente->display_name = 'Paciente';
        $rolPaciente->description  = 'Paciente del Sistema';
        $rolPaciente->save();

        // creamos el usuario administrador y un usuario de ejemplo
        $admin           = new User;
        $admin->email    = 'admin@admin.com';
        $admin->password = bcrypt('admin');
        $admin->name     = 'Administrador';
        $admin->gender   = 1;
        $admin->birthday = '11/01/1991';
        $admin->state_id = 1;
        $admin->save();
        $admin->attachRole($rolAdmin);

        $paciente           = new User;
        $paciente->email    = 'paciente@paciente.com';
        $paciente->password = bcrypt('paciente');
        $paciente->name     = 'Paciente';
        $paciente->lastname = 'de Prueba';
        $paciente->gender   = 0;
        $paciente->birthday = '11/01/1991';
        $paciente->state_id = 1;
        $paciente->save();
        $paciente->attachRole($rolPaciente);
    }
}

class UserSeeder extends Seeder
{
    const FAKES_USERS = 200;
    const USER_ROLE   = 2;
    /**
     * bcrypt = funcion para encriptar contraseñas, equivalente a Hash::make
     */
    public function run()
    {
        $rolPaciente = Role::findOrFail(self::USER_ROLE);

        for ($i = 0; $i < self::FAKES_USERS; $i++) {
            $user = factory(Tesis\Models\User::class)->create();
            $user->attachRole($rolPaciente);
        }
    }
}

/////////////////////////////////////////////////////////////////////////////
// Sirve para generar sintomas                                             //
/////////////////////////////////////////////////////////////////////////////
class SymptomSeeder extends Seeder
{
    public function run()
    {
        factory(Tesis\Models\Symptom::class, 50)->create();
    }
}

////////////////////////////////////////////////////////////////////////////////
// Sirve para generar enfermedades, las genera con síntomas, usar este script //
////////////////////////////////////////////////////////////////////////////////
class DiseaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        factory(Tesis\Models\Disease::class, 20)
            ->create()
            ->each(function ($disease) use ($faker) {

                $firstRule = DB::table('rules')->orderBy('id', 'desc')->first();

                if (empty($firstRule)) {
                    $nextRuleNumber = 1;
                } else {
                    $nextRuleNumber = intval($firstRule->number) + 1;
                }

                DB::table('rules')->insert([
                    [
                        'number'     => $nextRuleNumber,
                        'disease_id' => $disease->id,
                        'symptom_id' => $faker->numberBetween(1, 50),
                    ], [
                        'number'     => $nextRuleNumber,
                        'disease_id' => $disease->id,
                        'symptom_id' => $faker->numberBetween(1, 50),
                    ], [
                        'number'     => $nextRuleNumber,
                        'disease_id' => $disease->id,
                        'symptom_id' => $faker->numberBetween(1, 50),
                    ],
                ]);
            });
    }
}

// Sive para generar diagnosticos, para estadisticas
class DiagnosticSeeder extends Seeder
{
    const FAKES_DIAGNOSTIC = 500;
    public function run()
    {
        factory(Tesis\Models\Diagnostic::class, self::FAKES_DIAGNOSTIC)->create();
    }
}
