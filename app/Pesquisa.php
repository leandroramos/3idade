<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesquisa extends Model
{
    //
    protected $fillable = ['como_soube','disponibilidade_transporte','necessita_refeicao','atividades_profissionais', 'motivo_interesse', 'observacoes', 'candidato_id'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'pesquisas';

    public function candidato()
    {
        return $this->belongsTo('App\Candidato');
    }
}
