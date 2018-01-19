<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    //
    protected $fillable = ['cep', 'rua','numero','complemento','bairro', 'cidade', 'uf', 'candidato_id'];
    protected $guarded = ['id', 'created_at', 'update_at'];
    protected $table = 'enderecos';

    public function candidato()
    {
        return $this->belongsTo('App\Candidato');
    }
}
