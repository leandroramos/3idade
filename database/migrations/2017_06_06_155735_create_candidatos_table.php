<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public $table = "candidatos";

    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('nome');
            $table->string('rg', 20);
            $table->string('cpf', 14)->unique();
            $table->string('email');
            $table->string('telefone');
            $table->string('data_nascimento');
            $table->string('estado_civil')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidatos');
    }
}
