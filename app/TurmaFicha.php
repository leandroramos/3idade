<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TurmaFicha extends Model
{
    protected $fillable = ['ficha_id', 'turma_id'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'turmas_fichas';

    public function ficha()
    {
        return $this->belongsTo('App\Ficha');
    }
    
    public function turma()
    {
        return $this->belongsTo('App\Turma');
    }
}
