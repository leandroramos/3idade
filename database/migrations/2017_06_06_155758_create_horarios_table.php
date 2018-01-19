<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public $table = "horarios";

    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('dia_semana', 20);
            $table->string('hora_inicio', 20);
            $table->string('hora_fim', 20);

            $table->integer('disciplina_id')->unsigned();
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');

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
        Schema::dropIfExists('horarios');
    }
}
