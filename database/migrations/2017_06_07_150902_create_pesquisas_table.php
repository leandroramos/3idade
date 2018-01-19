<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesquisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public $table = "pesquisas";

    public function up()
    {
        Schema::create('pesquisas', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('como_soube', 255);
            $table->string('disponibilidade_transporte', 40);
            $table->string('necessita_refeicao', 40);
            $table->text('atividades_profissionais')->nullable();
            $table->text('motivo_interesse');
            $table->text('observacoes')->nullable();

            $table->integer('candidato_id')->unsigned();
            $table->foreign('candidato_id')->references('id')->on('candidatos');

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
        Schema::dropIfExists('pesquisas');
    }
}
