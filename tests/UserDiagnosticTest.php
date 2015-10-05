<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserDiagnosticTest extends TestCase
{
    use DatabaseTransactions;

    public function test_diagnostic_disease_list()
    {
        $this->makeUser();

        $this->visit('/user/diagnosticos/nuevo')
            ->see('Diagnosticar')
            ->assertViewHas('sintomas');
    }

    public function test_diagnostic_submit_without_fields()
    {
        $this->makeUser();

        $this->visit('/user/diagnosticos/nuevo')
            ->press('Diagnosticar')
            ->seePageIs('/user/diagnosticos/nuevo');

        $this->assertViewHas('sintomas');
    }
}
