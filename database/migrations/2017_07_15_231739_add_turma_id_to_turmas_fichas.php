<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTurmaIdToTurmasFichas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('turmas_fichas', function (Blueprint $table) {
            $table->integer('turma_id')->unsigned();
            $table->foreign('turma_id')->references('id')->on('turmas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('turmasFichas', function (Blueprint $table) {
            $table->dropColumn('turma_id');
        });
    }
}
