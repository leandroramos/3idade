<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    //
    protected $fillable = ['dia_semana','hora_inicio','hora_fim','disciplina_id'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'horarios';

    public function disciplina()
    {
        return $this->belongsTo('App\Disciplina');
    }
}
