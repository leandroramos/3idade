<?php

use App\Professor;
use Faker\Generator as Faker;

$factory->define(App\Disciplina::class, function (Faker $faker) {

    $requisitos = [
        null,
        'Nenhum',
        'Ter cursado a disciplina anterior',
        'Ser aprovado no teste prático',
        'Ter experiência profissional na área',
        'Ter ensino médio'
    ];

    return [
        'ano' => 2018,
        'semestre' => 1,
        'nome' => $faker->name,
        'requisitos' => $faker->randomElement($requisitos),
        'professor_id' => function () {
            return Professor::orderByRaw("RAND()")->take(1)->first()->id;
        },
        'departamento' => $faker->company
    ];
});