<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escolaridade extends Model
{
    //
    protected $fillable = ['nome', 'candidato_id'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'escolaridades';

    public function candidato()
    {
        return $this->belongsTo('App\Candidato');
    }
}