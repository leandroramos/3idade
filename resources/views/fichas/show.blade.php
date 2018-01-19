@extends('layouts.matricula')

@section('title', 'Candidatos')

@section('content')
<h1 class="page-header">Ficha de Matr&iacute;cula</h1>
<!--<h2 class="sub-header">Candidatos</h2>-->

<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))

    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="fechar">&times;</a></p>
    @endif
    @endforeach
</div> <!-- end .flash-message -->
<div class="container larger-font">
    <section id="requerimento-matricula">
<!--        <h1>
            <small>Universidade Aberta à Terceira Idade</small>
        </h1>-->
        <div class="row col-md-8">
            <p class="lead">
                Exmo. Sr. Diretor
            </p>
            <p>
                <strong>{{ $candidato->nome }}</strong>, R.G. <strong>{{ $candidato->rg }}</strong>, nascido em <strong>{{ $candidato->data_nascimento }}</strong>,
                residente &agrave; <strong>{{ $candidato->endereco->rua }}</strong> n&ordm; <strong>{{ $candidato->endereco->numero }} {{ $candidato->endereco->complemento }}</strong>, 
                bairro <strong>{{ $candidato->endereco->bairro }}</strong>, <strong>{{ $candidato->endereco->cidade }}</strong> - CEP <strong>{{ $candidato->endereco->cep }}</strong>, 
                telefone <strong>{{ $candidato->telefone }}</strong>, e-mail <strong>{{ $candidato->email }}</strong>,
                de escolaridade <strong>{{ $candidato->escolaridade }}</strong>, estado civil <strong>{{ $candidato->estado_civil }}</strong>,
                vem requerer sua matr&iacute;cula no {{ $semestre }}&ordm; semestre de {{ $ano }}, nas seguintes disciplinas e/ou atividades did&aacute;tico-culturais:
            </p>
        </div>
        <div class="row col-md-8">
            <div id="disciplinas-escolhidas">
                <ul>

                    
                    @foreach($disciplinas as $disciplina)

                    <li>
                        <span class="text-primary"><strong>{{ $disciplina->nome }}</strong></span><br>
                        Requisitos: <span class="text-danger"><strong>{{ $disciplina->requisitos }}</strong></span><br>
                        Horário:  
                        @foreach($turmas as $turma)
                            @foreach($disciplina->turmas as $disciplina_turma)
                                @if($disciplina_turma->id == $turma->id)
                                {{ $turma->horario }}
                                @endif
                            @endforeach
                        @endforeach
                        <br>
                        Professor respons&aacute;vel: <strong>{{ $disciplina->professor->nome }}</strong>
                    </li>

                    @endforeach

                </ul>
            </div>
            <hr>
            <div id="assinatura-candidato">
                {{-- <p>
                    Declaro que as informa&ccedil;&otilde;es acima são verdadeiras e 
                    estou ciente dos requisitos necessários para a matrícula.
                </p>
                <p>S&atilde;o Paulo, {{ date('d/m/Y') }}</p>
                <p class="linha-assinatura col-md-5 text-center">
                    {{ $candidato->nome }}
                </p> --}}
                <p>
                    <span>Inscri&ccedil;&atilde;o realizada em {{ date('d/m/Y à\s H:i:s', strtotime($ficha->created_at)) }}</span>
                </p>
            </div>
            
        </div>
    </section>
</div>
<div class="container">
    <section id="pesquisa-candidato">
        <hr>
        <p class="lead">Pesquisa</p>
        <p>
            <strong>Como soube  do Programa Universidade Aberta &agrave; Terceira Idade?</strong><br>
            {{ $candidato->pesquisa->como_soube }}<br>
            <strong>Disponibilidade de transporte:</strong><br>
            {{ $candidato->pesquisa->disponibilidade_transporte }}<br>
            <strong>Necessitar&aacute; de refei&ccedil;&atilde;o no dia da aula?</strong><br>
            {{ $candidato->pesquisa->necessita_refeicao }}<br>
            <strong>Atividades profissionais j&aacute; desenvolvidas:</strong><br>
            {{ $candidato->pesquisa->atividades_profissionais }}<br>
            <strong>Por que se interessou pelo projeto?</strong><br>
            {{ $candidato->pesquisa->motivo_interesse }}<br>
            <strong>Observa&ccedil;&otilde;es?</strong><br>
            {{ $candidato->pesquisa->observacoes }}
        </p>
    </section>
</div>
</div>
@endsection
