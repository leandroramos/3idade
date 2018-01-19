<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //factory(App\Professor::class, 15)->create();
        //factory(App\Disciplina::class, 10)->create();
        //factory(App\Candidato::class, 10)->create();
        //factory(App\Horario::class, 10)->create();
        //factory(App\Escolaridade::class, 10)->create();
        //factory(App\Pesquisa::class, 10)->create();
        factory(App\Endereco::class, 10)->create();
    }
}
