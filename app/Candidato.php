<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $fillable = ['nome','rg', 'cpf', 'email','telefone', 'data_nascimento', 'estado_civil'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'candidatos';

    // Relacionamentos entre as tabelas
    public function pesquisa()
    {
        return $this->hasOne('App\Pesquisa');
    }
    
    public function endereco()
    {
        return $this->hasOne('App\Endereco');
    }
    
    public function ficha()
    {
        return $this->hasOne('App\Ficha');
    }

    public function turmas_fichas()
    {
        return $this->hasManyThrough('App\TurmaFicha', 'App\Ficha');
    }
}
