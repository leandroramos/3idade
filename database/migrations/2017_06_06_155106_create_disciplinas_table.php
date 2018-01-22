<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public $table = "disciplinas";

    public function up()
    {
        Schema::create('disciplinas', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('nome', 255);
            $table->integer('vagas');
            $table->string('requisitos', 255)->nullable();

            $table->integer('professor_id')->unsigned();
            $table->foreign('professor_id')->references('id')->on('professores')->onDelete('cascade');

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
        
        Schema::dropIfExists('disciplinas');
        
    }
}
