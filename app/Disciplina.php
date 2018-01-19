<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    //
    protected $fillable = ['nome','requisitos','professor_id', 'departamento'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'disciplinas';

    public function professor()
    {
        return $this->belongsTo('App\Professor');
    }
    
    public function turmas()
    {
        return $this->hasMany('App\Turma');
    }
    
    public function turmas_fichas()
    {
        return $this->hasManyThrough('App\TurmaFicha', 'App\Turma');
    }
}
