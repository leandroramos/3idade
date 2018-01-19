<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscolaridadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public $table = "escolaridades";

    public function up()
    {
        Schema::create('escolaridades', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('nome');

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
        
        Schema::dropIfExists('escolaridades');
        
    }
}
