<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function test_login_page()
    {
        $this->visit('/')
            ->see('Mi Medico');
    }

    public function test_login_failed()
    {
        $this->visit('/')
            ->type('admin@admin.com', 'email')
            ->type(bcrypt('test_admin'), 'password')
            ->press(trans('messages.login.login'))
            ->seePageIs('/');
    }

    public function test_login_successful()
    {
        $user = factory(Tesis\Models\User::class)->create([
            'password' => bcrypt('test_user'),
        ]);
        $user->attachRole(2);

        $this->visit('/')
            ->type($user->email, 'email')
            ->type('test_user', 'password')
            ->press(trans('messages.login.login'))
            ->seePageIs('/user/inicio');
    }

    public function test_check_logout()
    {
        $this->visit('/cerrar')
            ->see('/');
    }
}
