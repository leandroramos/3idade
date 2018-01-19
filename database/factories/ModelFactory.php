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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     static $password;

//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'password' => $password ?: $password = bcrypt('secret'),
//         'remember_token' => str_random(10),
//     ];
// });

$factory->define(App\Professor::class, function (Faker\Generator $faker) {

     return [
         'nome' => $faker->name,
     ];
 });
//$faker = Faker\Factory::create('pt_BR');

$factory->define(App\Candidato::class, function (Faker\Generator $faker) {

    return [
        'nome' => $faker->name,
        'rg' => '123456-2',
        'email' => $faker->unique()->safeEmail,
        'telefone' => $faker->phoneNumber,
        'data_nascimento' => $faker->dateTimeThisCentury->format('d-m-Y'),
        'estado_civil' => $faker->randomElement($array = array ('Casado','Solteiro','Divorciado', 'Viúvo')),
    ];
});

$factory->define(App\Disciplina::class, function (Faker\Generator $faker) {

    return [
        'nome' => $faker->realText(rand(10,20)),
        'vagas' => $faker->numberBetween($min = 1, $max = 8),
        'requisitos' => $faker->randomElement($array = array ('Nenhum','Superior Completo','Mestrado', 'Experiência profissional na área')),
        'professor_id' => $faker->unique()->numberBetween($min = 1, $max = 15),
    ];
});

$factory->define(App\Horario::class, function (Faker\Generator $faker) {

    return [
        'dia_semana' => $faker->dayOfWeek,
        'hora_inicio' => $faker->time($format = 'H:i'),
        'hora_fim' => $faker->time($format = 'H:i'),
        'disciplina_id' => $faker->unique()->numberBetween($min = 1, $max = 10),
    ];
});

$factory->define(App\Escolaridade::class, function (Faker\Generator $faker) {

    return [
        'nome' => $faker->randomElement($array = array ('Fundamental incompleto', 'Fundamental Completo', 'Médio Incompleto', 'Médio Completo', 'Superior incompleto', 'Superior completo')),
    ];
});

$factory->define(App\Pesquisa::class, function (Faker\Generator $faker) {

    return [
        'como_soube' => $faker->text($maxNbChars = 20),
        'disponibilidade_transporte' => $faker->randomElement($array = array ('Sim', 'Não')),
        'necessita_refeicao' => $faker->randomElement($array = array ('Sim', 'Não')),
        'atividades_profissionais' => $faker->text($maxNbChars = 200),
        'motivo_interesse' => $faker->text($maxNbChars = 20),
        'observacoes' => $faker->text($maxNbChars = 100),
        'candidato_id' => $faker->unique()->numberBetween($min = 1, $max = 10),
    ];
});

$factory->define(App\Endereco::class, function (Faker\Generator $faker) {

    return [
        'cep' => '12345-032',
        'rua' => $faker->streetName,
        'numero' => $faker->buildingNumber,
        'complemento' => $faker->secondaryAddress,
        'bairro' => $faker->city,
        'cidade' => $faker->city,
        'uf' => $faker->stateAbbr,
        'candidato_id' => $faker->unique()->numberBetween($min = 1, $max = 10),
    ];
});