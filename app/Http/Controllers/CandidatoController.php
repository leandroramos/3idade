<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidato;
use App\Escolaridade;
use App\Disciplina;
use App\Endereco;
use App\Pesquisa;
use App\Ficha;
use App\TurmaFicha;
use App\Turma;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use \DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MatriculaEfetuada;
use App\Mail\NotificaCCEX;

class CandidatoController extends Controller
{

    protected $candidato;
    protected $endereco;
    protected $pesquisa;
    protected $ficha;
    protected $turmas;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'index']);
        /**
         * A ficha que será enviada por email
         */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $departamentos = [];
        
        //$disciplinas = Disciplina::has('turmas')->with('professor')->orderBy('departamento')->get();
        //dd("Ano: " . env('ANO') . " - Semestre: " . env('SEMESTRE'));
        $disciplinas = Disciplina::where([['ano', env('ANO')], ['semestre', env('SEMESTRE')]])->has('turmas')->with('professor')->orderBy('departamento')->get();
        
        foreach ($disciplinas as $disciplina) {
            array_push($departamentos, $disciplina->departamento);
        }

        $departamentos = array_unique($departamentos);

        // recuperando as escolaridades
        $escolaridades = Escolaridade::all();
        return view('candidatos.create', compact('departamentos', 'escolaridades', 'disciplinas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Validator::extend('olderThan', function($attribute, $value, $parameters)
        {
            $value = str_replace('/', '-', $value);
            $minAge = ( ! empty($parameters)) ? (int) $parameters[0] : 60;
            return (new DateTime)->diff(new DateTime($value))->y >= $minAge;
        });

        $validator = Validator::make($request->all(), [
            'turmasSelecionadas'        => 'required',
            'nome'                      => 'required',
            'rg'                        => 'required',
            'cpf'                       => 'required|cpf|unique:candidatos',
            'email'                     => 'required',
            'email'                     => 'email',
            'data_nascimento'           => 'required|olderThan:60',
            'escolaridade'              => 'required',
            'cep'                       => 'required',
            'rua'                       => 'required',
            'numero'                    => 'required',
            'cidade'                    => 'required',
            'telefone'                  => 'required',
            'como_soube'                => 'required',
            'disponibilidade_transporte'=> 'required',
            'necessita_refeicao'        => 'required',
            'motivo_interesse'          => 'required',
            'termo_responsabilidade'    => 'accepted'
        ],[
            'turmasSelecionadas.required'       => 'Você precisa escolher pelo menos uma disciplina para continuar.'
        ]);
        
        if ($validator->fails()) {
            return redirect('candidatos/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $this->candidato      = new Candidato;
        $this->endereco       = new Endereco;
        $this->pesquisa       = new Pesquisa;
        $this->ficha          = new Ficha; // A ficha de inscrição do candidato
        
        $this->candidato->nome              = $request->nome;
        $this->candidato->rg                = $request->rg;
        $this->candidato->cpf               = $request->cpf;
        $this->candidato->email             = $request->email;
        $this->candidato->telefone          = $request->telefone;
        $this->candidato->data_nascimento   = $request->data_nascimento;
        $this->candidato->estado_civil      = $request->estado_civil;
        $this->candidato->escolaridade      = $request->escolaridade;
        $this->endereco->cep                = $request->cep;
        $this->endereco->rua                = $request->rua;
        $this->endereco->numero             = $request->numero;
        $this->endereco->complemento        = $request->complemento;
        $this->endereco->bairro             = $request->bairro;
        $this->endereco->cidade             = $request->cidade;
        $this->endereco->uf                 = $request->uf;
        $this->pesquisa->como_soube                           = $request->como_soube;
        $this->pesquisa->disponibilidade_transporte           = $request->disponibilidade_transporte;
        $this->pesquisa->necessita_refeicao                   = $request->necessita_refeicao;
        $this->pesquisa->atividades_profissionais             = $request->atividades_profissionais;
        $this->pesquisa->motivo_interesse                     = $request->motivo_interesse;
        $this->pesquisa->observacoes                          = $request->observacoes;
        
        $this->turmas = array_filter(explode('-', $request->turmasSelecionadas), function($valor) {
            return !empty($valor);
        });

        try {
            DB::transaction(function()
            {

                $this->candidato->save();
                
                $candidato_id = $this->candidato->id;

                
                
                $this->ficha->candidato_id = $candidato_id;
                
                Candidato::find($candidato_id)->endereco()->save($this->endereco);
                Candidato::find($candidato_id)->pesquisa()->save($this->pesquisa);
                Candidato::find($candidato_id)->ficha()->save($this->ficha);
                
                foreach ($this->turmas as $turma) {
                    $turma_ficha = new TurmaFicha; // A(s) turma(s) selecionadas para a inscrição do candidato
                    $turma_ficha->ficha_id = $this->ficha->id;
                    $turma_ficha->turma_id = $turma;
                    Ficha::find($this->ficha->id)->turmas_fichas()->save($turma_ficha);
                    // Dar baixa na vaga da turma
                    $turmaSelecionada = Turma::find($turma);
                    $turmaSelecionada->vagas = $turmaSelecionada->vagas - 1;
                    $turmaSelecionada->save();
                }

                self::notificaMatricula($this->candidato->id);
            });

            $request->session()->flash('alert-success', 'Sua inscrição foi feita. Enviamos um e-mail com os dados de sua matrícula. Obrigado!');
            return Redirect()->route('fichas.show', ['pageID' => encrypt($this->candidato->id)]);
        } catch (Exception $e) {
            $request->session()->flash('alert-danger', 'Houve um erro.');
            return back()->withInput();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $candidatos             = Candidato::where([['ano', env('ANO')], ['semestre', env('SEMESTRE')]])
                                    ->with('ficha')->get();
        $collectionCandidatos   = [];
        $turmas                 = [];
        $ficha                  = [];
        $disciplinas            = [];

        foreach ($candidatos as $candidato) {
            $candidatoFinal = $this->getTurmasCandidato($candidato->id);
            array_push($collectionCandidatos, $candidatoFinal);
        }

        return View::make('candidatos.index')
            ->with('candidatos', $collectionCandidatos);
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

    protected function notificaMatricula($candidato_id)
    {
        $data          = getdate();
        $ano           = $data['year'];
        $semestre      = $data['mon'] < 7 ? '1' : '2';
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
            $disciplina = Disciplina::find($turma->disciplina_id);
            array_push($disciplinas, $disciplina);
        }

        //E-mail para a CCEX
        Mail::to('ccex-eca@usp.br')->send(new NotificaCCEX($candidato, $turmas, $ficha, $disciplinas, $ano, $semestre));
        //E-mail para o candidato
        Mail::to($candidato->email)->send(new MatriculaEfetuada($candidato, $turmas, $ficha, $disciplinas, $ano, $semestre));
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
        $candidato = Candidato::findOrFail($id);
        return view('candidatos.edit',compact('candidato'));
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
        $candidato = Candidato::findOrFail($id);
        $candidato->nome            = $request->nome;
        $candidato->rg              = $request->rg;
        $candidato->cpf             = $request->cpf;
        $candidato->email           = $request->email;
        $candidato->telefone        = $request->telefone;
        $candidato->data_nascimento = $request->data_nascimento;
        $candidato->estado_civil    = $request->estado_civil;
        $candidato->save();
        return redirect()->route('candidatos.index')->with('message', 'Candidato atualizado com sucesso!');
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
        $candidato = Candidato::findOrFail($id);
        $candidato->delete();
        return redirect()->route('candidatos.index')->with('alert-success','Candidato deletado!');
    }
}
