<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disciplina;
use App\Professor;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class DisciplinaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $disciplinas = Disciplina::where([['ano', env('ANO')], ['semestre', env('SEMESTRE')]])->get();

        return View::make('disciplinas.index')
            ->with('disciplinas', $disciplinas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Recuperando os departamentos
        $departamentos = self::getDepartamentos();
        // Recuperando os professores
        $professores = Professor::all();
        return view('disciplinas.create', compact('professores', 'departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ano'               => 'required|numeric',
            'semestre'          => 'required',
            'departamento'      => 'required',
            'nome'              => 'required',
            'professor_id'         => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect('disciplinas/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // As turmas estão em outra tabela no BD
        $disciplina = new Disciplina;
        $disciplina->ano            = $request->ano;
        $disciplina->semestre       = $request->semestre;
        $disciplina->nome           = $request->nome;
        //$disciplina->vagas          = $request->vagas;
        $disciplina->requisitos     = $request->requisitos;
        $disciplina->professor_id   = $request->professor_id;
        $disciplina->departamento   = $request->departamento;
        //$disciplina->dia_semana     = $request->dia_semana;
        //$disciplina->hora_inicio    = $request->hora_inicio;
        //$disciplina->hora_fim       = $request->hora_fim;
        
        
        
        $disciplina->save();
        return redirect()->route('disciplinas.index')->with('message', 'Disciplina criada com sucesso!');
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
    
    public function getDepartamentos()
    {
        // Setando os departamentos - Fazer isso no BD?
        $departamentos = [
            'Artes Cênicas – CAC',
            'Artes Plásticas – CAP',
            'Informação e Cultura – CBD',
            'Comunicações e Artes – CCA',
            'Jornalismo e Editoração – CJE',
            'Música – CMU',
            'Relações Públicas, Propaganda e Turismo – CRP',
            'Cinema, Rádio e Televisão – CTR'
        ];
        return $departamentos;
    }
    
    public function getDiasDaSemana()
    {
        // Setando os departamentos - Fazer isso no BD?
        $diasDaSemana = [
            'Segunda-feira',
            'Terça-feira',
            'Quarta-feira',
            'Quinta-feira',
            'Sexta-feira',
            'Sábado',
            'Domingo'
        ];
        return $diasDaSemana;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departamentos = self::getDepartamentos();
        // Recuperando os professores
        $professores = Professor::all();
        $disciplina = Disciplina::findOrFail($id);
        $departamentoSelecionado = $disciplina->departamento;
        return view('disciplinas.edit',compact('disciplina', 'professores', 'departamentos', 'departamentoSelecionado'));
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
        $validator = Validator::make($request->all(), [
            'ano'               => 'required|numeric',
            'semestre'          => 'required',
            'departamento'      => 'required',
            'nome'              => 'required',
            'professor_id'         => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect("disciplinas/$id/edit")
                        ->withErrors($validator)
                        ->withInput();
        }

        $disciplina = Disciplina::findOrFail($id);
        $disciplina->semestre       = $request->semestre;
        $disciplina->nome           = $request->nome;
        $disciplina->nome           = $request->nome;
        //$disciplina->vagas          = $request->vagas;
        $disciplina->requisitos     = $request->requisitos;
        $disciplina->professor_id   = $request->professor_id;
        $disciplina->departamento   = $request->departamento;
        //$disciplina->dia_semana     = $request->dia_semana;
        //$disciplina->hora_inicio    = $request->hora_inicio;
        //$disciplina->hora_fim       = $request->hora_fim;
        $disciplina->save();
        return redirect()->route('disciplinas.index')->with('message', 'Disciplina atualizada com sucesso!');
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
        $disciplina = Disciplina::findOrFail($id);
        $disciplina->delete();
        return redirect()->route('disciplinas.index')->with('alert-success','Disciplina deletada!');
    }
}
