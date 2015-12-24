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

    public function test_register_fail()
    {
        $user = factory(Tesis\Models\User::class)->make();

        $this->visit('/register')
            ->press(trans('messages.register.submit'))
            ->seePageIs('/register');
    }

    public function test_register_successful()
    {
        $user = factory(Tesis\Models\User::class)->make();

        $this->visit('/register')
            ->type($user->name, 'name')
            ->type($user->email, 'email')
            ->type('testpass', 'password')
            ->type('testpass', 'password_confirmation')
            ->select('1', 'gender')
            ->check('confirmed')
            ->press(trans('messages.register.submit'))
            ->seePageIs('/');

        $this->seeInDatabase('users', ['email' => $user->email]);
    }

    public function test_check_logout()
    {
        $this->visit('/logout')
            ->see('/');
    }
}
