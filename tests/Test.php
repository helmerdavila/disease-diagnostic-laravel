<?php

class Test extends TestCase
{

    public function testLoginPage()
    {
        $this->visit('/')
            ->see('Mi Medico');
    }

    public function testLoginFailed()
    {
        $this->visit('/')
            ->type('admin@admin.com', 'email')
            ->press('Entrar')
            ->seePageIs('/');
    }

    public function testLoginSuccessful()
    {
        $user = factory(Tesis\Models\User::class)->create();
        $user->attachRole(2);

        $this->visit('/')
            ->type($user->email, 'email')
            ->type('pruebasistema', 'password')
            ->press('Entrar')
            ->seePageIs('/user/inicio');
    }

    public function testCheckLogout()
    {
        $this->visit('/cerrar')
            ->see('/');
    }
}
