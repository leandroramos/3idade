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
        factory(App\Professor::class, 20)->create();
        factory(App\Disciplina::class, 35)->create();
        factory(App\Turma::class, 67)->create();
    }
}
