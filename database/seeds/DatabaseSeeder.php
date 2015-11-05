<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Tesis\Models\Role;
use Tesis\Models\User;

class DatabaseSeeder extends Seeder
{

    /**
     * Set foreign key hace que se active y desactive las
     * claves foraneas para poder limpiar la base de
     * datos sin que aparezca ningun tipo de errores
     */
    public function run()
    {
        Model::unguard();
        $this->call(TruncateTables::class);
        $this->call(UserTableSeeder::class);
        $this->call(SymptomSeeder::class);
        $this->call(DiseaseSeeder::class);
        $this->call(DiagnosticSeeder::class);
        Model::reguard();
    }
}

class TruncateTables extends Seeder
{
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

class UserTableSeeder extends Seeder
{
    /**
     * bcrypt = funcion para encriptar contraseñas, equivalente a Hash::make
     */
    public function run()
    {
        //creamos primero rol administrador y de usuario
        $rolAdmin               = new Role;
        $rolAdmin->name         = 'admin';
        $rolAdmin->display_name = 'Administrador';
        $rolAdmin->description  = 'Usuario con todos los permisos del sistema';
        $rolAdmin->save();

        $rolUsuario               = new Role;
        $rolUsuario->name         = 'usuario';
        $rolUsuario->display_name = 'Usuario';
        $rolUsuario->description  = 'Usuario común del sistema';
        $rolUsuario->save();

        // creamos el usuario administrador y un usuario de ejemplo
        $admin             = new User;
        $admin->email      = 'admin@admin.com';
        $admin->password   = bcrypt('administrador');
        $admin->name       = 'Administrador';
        $admin->gender     = 1;
        $admin->birthday   = '1991-01-11';
        $usuario->state_id = 1;
        $admin->save();
        $admin->attachRole($rolAdmin);

        $usuario           = new User;
        $usuario->email    = 'usuario@usuario.com';
        $usuario->password = bcrypt('usuario');
        $usuario->name     = 'Lesly Yohana';
        $usuario->lastname = 'Nomberto Coronado';
        $usuario->gender   = 0;
        $usuario->birthday = '1991-01-11';
        $usuario->state_id = 1;
        $usuario->save();
        $usuario->attachRole($rolUsuario);

        for ($i = 0; $i < 200; $i++) {
            $user = factory(Tesis\Models\User::class)->create();
            $user->attachRole($rolUsuario);
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
                $disease->rules()->sync([
                    $faker->numberBetween(1, 50),
                    $faker->numberBetween(1, 50),
                    $faker->numberBetween(1, 50),
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
