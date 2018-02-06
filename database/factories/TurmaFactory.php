<?php

use App\Disciplina;
use App\Turma;
use Faker\Generator as Faker;

$factory->define(App\Turma::class, function (Faker $faker) {

    return [
        'horario' => $faker->randomElement($array = array(
            'Segunda-feira das 8:00 às 11:45',
            'Segunda-feira das 19:30 às 22:45',
            'Terça-feira das 8:00 às 11:45',
            'Terça-feira das 19:30 às 22:45',
            'Quarta-feira das 8:00 às 11:45',
            'Quarta-feira das 19:30 às 22:45',
            'Quinta-feira das 8:00 às 11:45',
            'Quinta-feira das 19:30 às 22:45',
            'Sexta-feira das 8:00 às 11:45',
            'Sexta-feira das 19:30 às 22:45'
        )),
        'vagas' => $faker->numberBetween($min = 1, $max = 10),
        'disciplina_id' => function () {
            return Disciplina::orderByRaw("RAND()")->take(1)->first()->id;
        }
    ];
});