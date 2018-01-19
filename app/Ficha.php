<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    protected $fillable = ['candidato_id'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'fichas';

    public function candidato()
    {
        return $this->belongsTo('App\Candidato');
    }
    
    public function turmas_fichas()
    {
        return $this->hasMany('App\TurmaFicha');
    }
}
