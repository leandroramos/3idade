<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Escolaridade;
use Illuminate\Support\Facades\View;

class EscolaridadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $escolaridades = Escolaridade::all();

        return View::make('escolaridades.index')
            ->with('escolaridades', $escolaridades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('escolaridades.create');
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
        $escolaridade = new Escolaridade;
        $escolaridade->nome           = $request->nome;
        $escolaridade->candidato_id   = $request->candidato_id;
        $escolaridade->save();
        return redirect()->route('escolaridades.index')->with('message', 'Escolaridade criada com sucesso!');
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
        $disciplina = Escolaridade::findOrFail($id);
        return view('escolaridades.edit',compact('escolaridade'));
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
        $escolaridade = Escolaridade::findOrFail($id);
        $escolaridade = new Escolaridade;
        $escolaridade->nome           = $request->nome;
        $escolaridade->candidato_id   = $request->candidato_id;
        $escolaridade->save();
        return redirect()->route('escolaridades.index')->with('message', 'Escolaridade atualizada com sucesso!');
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
        $escolaridade = Escolaridade::findOrFail($id);
        $escolaridade->delete();
        return redirect()->route('escolaridades.index')->with('alert-success','Escolaridade deletada!');
    }
}
