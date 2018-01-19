<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $enderecos = Endereco::all();

        return View::make('enderecos.index')
            ->with('enderecos', $enderecos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('enderecos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $endereco = new Endereco;
        $endereco->cep           = $request->cep;
        $endereco->rua          = $request->rua;
        $endereco->numero     = $request->numero;
        $endereco->complemento   = $request->complemento;
        $endereco->bairro   = $request->bairro;
        $endereco->cidade   = $request->cidade;
        $endereco->uf   = $request->uf;
        $endereco->candidato_id   = $request->candidato_id;
        $endereco->save();
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $endereco = Endereco::findOrFail($id);
        return view('enderecos.edit',compact('endereco'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $endereco = new Endereco;
        $endereco->cep           = $request->cep;
        $endereco->rua          = $request->rua;
        $endereco->numero     = $request->numero;
        $endereco->complemento   = $request->complemento;
        $endereco->bairro   = $request->bairro;
        $endereco->cidade   = $request->cidade;
        $endereco->uf   = $request->uf;
        $endereco->candidato_id   = $request->candidato_id;
        $endereco->save();

        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $endereco = Endereco::findOrFail($id);
        $endereco->delete();
        return true;
    }
}
