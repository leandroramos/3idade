<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    //
    protected $fillable = ['horario','vagas','disciplina_id'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'turmas';

    public function disciplina()
    {
        return $this->hasOne('App\Disciplina');
    }
    
    public function turma_ficha()
    {
        return $this->hasOne('App\TurmaFicha');
    }
}
