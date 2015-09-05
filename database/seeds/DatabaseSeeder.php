<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
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
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(TruncateTables::class);
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}

class TruncateTables extends Seeder
{
    public function run()
    {
        \DB::table('role_user')->truncate();
        \DB::table('roles')->truncate();
        \DB::table('users')->truncate();
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
        $rolAdmin = new Role;
        $rolAdmin->name = 'admin';
        $rolAdmin->display_name = 'Administrador';
        $rolAdmin->description = 'Usuario con todos los permisos del sistema';
        $rolAdmin->save();

        $rolUsuario = new Role;
        $rolUsuario->name = 'usuario';
        $rolUsuario->display_name = 'Usuario';
        $rolUsuario->description = 'Usuario común del sistema';
        $rolUsuario->save();

        // creamos el usuario administrador y un usuario de ejemplo
        $admin = new User;
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('administrador');
        $admin->name = 'Administrador';
        $admin->gender = 1;
        $admin->birthday = '1991-01-11';
        $admin->save();
        $admin->attachRole($rolAdmin);

        $usuario = new User;
        $usuario->email = 'usuario@usuario.com';
        $usuario->password = bcrypt('usuario');
        $usuario->name = 'Lesly Yohana';
        $usuario->lastname = 'Nomberto Coronado';
        $usuario->gender = 0;
        $usuario->birthday = '1991-01-11';
        $usuario->save();
        $usuario->attachRole($rolUsuario);

        for ($i = 0; $i < 200; $i++) {
            $user = factory(Tesis\Models\User::class)->create();
            $user->attachRole($rolUsuario);
        }

    }
}
