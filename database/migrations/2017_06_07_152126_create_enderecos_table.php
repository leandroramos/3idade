<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public $table = "enderecos";

    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('cep', 9);
            $table->string('rua');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade');
            $table->string('uf', 2);

            $table->integer('candidato_id')->unsigned();
            $table->foreign('candidato_id')->references('id')->on('candidatos')->onDelete('cascade');

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
