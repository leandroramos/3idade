<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Horario;
use Illuminate\Support\Facades\View;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $horarios = Horario::all();

        return View::make('horarios.index')
            ->with('horarios', $horarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('horarios.create');
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
        $horario = new Horario;
        $horario->dia_semana     = $request->dia_semana;
        $horario->hora_inicio    = $request->hora_inicio;
        $horario->hora_fim       = $request->hora_fim;
        $horario->disciplina_id  = $request->disciplina_id;
        $horario->save();
        return redirect()->route('horarios.index')->with('message', 'Horário criado com sucesso!');
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
        $horario = Horario::findOrFail($id);
        return view('horarios.edit',compact('horario'));
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
        $horario = Horario::findOrFail($id);
        $horario = new Horario;
        $horario->dia_semana     = $request->dia_semana;
        $horario->hora_inicio    = $request->hora_inicio;
        $horario->hora_fim       = $request->hora_fim;
        $horario->disciplina_id  = $request->disciplina_id;
        $horario->save();
        return redirect()->route('horarios.index')->with('message', 'Horário atualizado com sucesso!');

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
        $horario = Horario::findOrFail($id);
        $horario->delete();
        return redirect()->route('horarios.index')->with('alert-success','Horário deletado!');
    }
}
