<?php

$factory->define(Tesis\Models\User::class, function ($faker) {

    return [
        'name' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->email,
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'phone' => $faker->unique()->randomNumber(6),
        'mobil' => $faker->unique()->randomNumber(9),
        'gender' => $faker->numberBetween(0, 1),
        'password' => bcrypt('pruebasistema'),
    ];
});
