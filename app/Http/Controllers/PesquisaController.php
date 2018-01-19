<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesquisa;
use Illuminate\Support\Facades\View;

class PesquisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pesquisas = Pesquisa::all();

        return View::make('pesquisas.index')
            ->with('pesquisas', $pesquisas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pesquisas.create');
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
        $pesquisa = new Pesquisa;
        $pesquisa->como_soube                   = $request->como_soube;
        $pesquisa->disponibilidade_transporte   = $request->disponibilidade_transporte;
        $pesquisa->necessita_refeicao           = $request->necessita_refeicao;
        $pesquisa->atividades_profissionais     = $request->atividades_profissionais;
        $pesquisa->motivo_interesse             = $request->motivo_interesse;
        $pesquisa->observacoes                  = $request->observacoes;
        $pesquisa->candidato_id                 = $request->candidato_id;
        $pesquisa->save();
        return redirect()->route('pesquisas.index')->with('message', 'Pesquisa criada com sucesso!');
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
        $pesquisa = Pesquisa::findOrFail($id);
        return view('pesquisas.edit',compact('pesquisa'));
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
        $pesquisa = Pesquisa::findOrFail($id);
        $pesquisa = new Pesquisa;
        $pesquisa->como_soube                   = $request->como_soube;
        $pesquisa->disponibilidade_transporte   = $request->disponibilidade_transporte;
        $pesquisa->necessita_refeicao           = $request->necessita_refeicao;
        $pesquisa->atividades_profissionais     = $request->atividades_profissionais;
        $pesquisa->motivo_interesse             = $request->motivo_interesse;
        $pesquisa->observacoes                  = $request->observacoes;
        $pesquisa->candidato_id                 = $request->candidato_id;
        $pesquisa->save();
        return redirect()->route('pesquisas.index')->with('message', 'Pesquisa atualizada com sucesso!');
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
        $pesquisa = Pesquisa::findOrFail($id);
        $pesquisa->delete();
        return redirect()->route('pesquisas.index')->with('alert-success','pesquisa deletada!');
    }
}
