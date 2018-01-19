<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    //
    protected $fillable = ['nome'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'professores';

    public function disciplina()
    {
        return $this->hasMany('App\Disciplina');
    }
}