<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserDiagnosticTest extends TestCase
{
    use DatabaseTransactions;

    public function test_diagnostic_disease_list()
    {
        $this->authUser()
            ->visit('/user/diagnosticos/nuevo')
            ->see('Continuar')
            ->assertViewHas('sintomas');
    }

    public function test_diagnostic_continue()
    {
        $symptom_one = factory(Tesis\Models\Symptom::class)->create();
        $symptom_two = factory(Tesis\Models\Symptom::class)->create();
        $disease     = factory(Tesis\Models\Disease::class)->create();

        Tesis\Models\Rule::create([
            'number'     => 999,
            'disease_id' => $disease->id,
            'symptom_id' => $symptom_one->id,
        ]);
        Tesis\Models\Rule::create([
            'number'     => 999,
            'disease_id' => $disease->id,
            'symptom_id' => $symptom_two->id,
        ]);

        $this->authUser()
            ->visit('/user/diagnosticos/nuevo')
            ->select($symptom_one->id, 'sintoma')
            ->press('Continuar')
            ->seePageIs('/user/diagnosticos/analizar')
            ->assertResponseOk();

        $this->assertViewHas('sintomas');
    }
}
