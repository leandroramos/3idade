<?php

namespace App\Http\Controllers;

use App\Ficha;
use App\Candidato;
use App\Disciplina;
use App\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\MatriculaEfetuada;
use App\Mail\NotificaCCEX;

class FichaController extends Controller
{
    
    protected $matricula;
    protected $turmas_matricula;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departamentos = [];

        $alunosDepartamento = [];
        
        $disciplinas = Disciplina::has('turmas')->with('professor')->orderBy('departamento')->get();
        
        foreach ($disciplinas as $disciplina) {
            array_push($departamentos, $disciplina->departamento);
        }

        $departamentos = array_unique($departamentos);

        $candidatos             = Candidato::with('ficha')->get();
        $collectionCandidatos   = [];
        $turmas                 = [];
        $ficha                  = [];
        $disciplinas            = [];

        foreach ($candidatos as $candidato) {
            $candidatoFinal = $this->getTurmasCandidato($candidato->id);
            array_push($collectionCandidatos, $candidatoFinal);
        }

        foreach ($collectionCandidatos as $candidato) {
            foreach ($candidato['disciplinas'] as $disciplina) {
                
            }
        }

        return View::make('fichas.index')
            ->with('candidatos', $collectionCandidatos)->with('departamentos', $departamentos);
    }

    protected function getTurmasCandidato($candidato_id)
    {
        $candidato     = Candidato::findOrFail($candidato_id);
        $ficha         = Ficha::where('candidato_id', $candidato_id)->first();

        $candidatoComTurmas = Candidato::with('ficha')->has('turmas_fichas')->with('turmas_fichas')->with('pesquisa')->find($candidato_id);
        
        $turmas_fichas_candidato = $candidatoComTurmas->turmas_fichas;
        //dd($turmas_fichas_candidato);
        $turmas = [];

        foreach ($turmas_fichas_candidato as $turma_ficha) {
            $turma = Turma::find($turma_ficha->turma_id);
            array_push($turmas, $turma);
        }

        $disciplinas = [];

        foreach ($turmas as $turma) {
            $disciplina = Disciplina::with('turmas')->find($turma->disciplina_id);
            array_push($disciplinas, $disciplina);
        }

        $candidatoFinal = [
            'candidato'     => $candidato,
            'turmas'        => $turmas,
            'ficha'         => $ficha,
            'disciplinas'   => $disciplinas
        ];

        return $candidatoFinal;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidato_id  = decrypt($id);
        $data          = getdate();
        $ano           = $data['year'];
        $semestre      = $data['mon'] < 7 ? '1' : '2';
        $candidato     = Candidato::findOrFail($candidato_id);
        $ficha         = Ficha::where('candidato_id', $candidato_id)->first();

        $candidatoComTurmas = Candidato::with('ficha')->has('turmas_fichas')->with('turmas_fichas')->with('pesquisa')->find($candidato_id);
        
        $turmas_fichas_candidato = $candidatoComTurmas->turmas_fichas;
        
        $turmas = [];

        foreach ($turmas_fichas_candidato as $turma_ficha) {
            $turma = Turma::find($turma_ficha->turma_id);
            array_push($turmas, $turma);
        }
        //dd($turmas);

        $disciplinas = [];

        foreach ($turmas as $turma) {
            $disciplina = Disciplina::with('turmas')->find($turma->disciplina_id);

            array_push($disciplinas, $disciplina);
        }
        //dd($disciplinas);
        

        //$envio = self::notificaMatricula($candidato, $ficha, $disciplinas, $ano, $semestre);

        return view('fichas.show',compact('candidato', 'turmas', 'ficha', 'disciplinas', 'ano', 'semestre'));
    }

    // protected function notificaMatricula($candidato, $ficha, $disciplinas, $ano, $semestre)
    // {
    //     //E-mail para a CCEX
    //     Mail::to('ccex-eca@usp.br')->send(new NotificaCCEX($candidato, $ficha, $disciplinas, $ano, $semestre));
    //     //E-mail para o candidato
    //     Mail::to($candidato->email)->send(new MatriculaEfetuada($candidato, $ficha, $disciplinas, $ano, $semestre));
    // }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function edit(Ficha $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ficha $ficha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ficha  $ficha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ficha $ficha)
    {
        //
    }
}
