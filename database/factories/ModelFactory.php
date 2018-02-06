<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// $factory->define(App\Candidato::class, function (Faker\Generator $faker) {

//     return [
//         'nome' => $faker->name,
//         'rg' => '123456-2',
//         'email' => $faker->unique()->safeEmail,
//         'telefone' => $faker->phoneNumber,
//         'data_nascimento' => $faker->dateTimeThisCentury->format('d-m-Y'),
//         'estado_civil' => $faker->randomElement($array = array ('Casado','Solteiro','Divorciado', 'Viúvo')),
//     ];
// });

// $factory->define(App\Pesquisa::class, function (Faker\Generator $faker) {

//     return [
//         'como_soube' => $faker->text($maxNbChars = 20),
//         'disponibilidade_transporte' => $faker->randomElement($array = array ('Sim', 'Não')),
//         'necessita_refeicao' => $faker->randomElement($array = array ('Sim', 'Não')),
//         'atividades_profissionais' => $faker->text($maxNbChars = 200),
//         'motivo_interesse' => $faker->text($maxNbChars = 20),
//         'observacoes' => $faker->text($maxNbChars = 100),
//         'candidato_id' => $faker->unique()->numberBetween($min = 1, $max = 10),
//     ];
// });

// $factory->define(App\Endereco::class, function (Faker\Generator $faker) {

//     return [
//         'cep' => '12345-032',
//         'rua' => $faker->streetName,
//         'numero' => $faker->buildingNumber,
//         'complemento' => $faker->secondaryAddress,
//         'bairro' => $faker->city,
//         'cidade' => $faker->city,
//         'uf' => $faker->stateAbbr,
//         'candidato_id' => $faker->unique()->numberBetween($min = 1, $max = 10),
//     ];
// });