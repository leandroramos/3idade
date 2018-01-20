<?php use Illuminate\Support\Facades\Input; ?>
@extends('layouts.matricula')

@section('title', 'Candidatos')

@section('content')
<!-- <h1 class="page-header">Administra&ccedil;&atilde;o do Sistema</h1> -->
<h1 class="sub-header">Formulário de Inscrição</h1>
<div class="container">
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="fechar">&times;</a></p>
        @endif
        @endforeach
    </div> <!-- end .flash-message -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Modal com as disciplinas e turmas -->
    <div class="center"><button data-toggle="modal" data-keyboard="false" data-target="#squarespaceModal" class="btn btn-primary center-block">Selecionar disciplinas e turmas</button></div>


    <!-- line modal -->
    <div class="modal fade" id="squarespaceModal" data-backdrop="static" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Fechar</span></button>-->
                    <h3 class="modal-title" id="lineModalLabel">Disciplinas</h3>

                </div>
                <div class="modal-body"> 

                    <table class="table">

                        <!-- content goes here -->
                        <div class="panel panel-default">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="text-danger">Você pode escolher até duas disciplinas.</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($departamentos as $departamento)
                                <tr>
                                    <td>
                                        <div class="panel-heading">
                                            <span class="text-primary">{{ $departamento }}</span>
                                        </div>
                                        @foreach($disciplinas as $disciplina)
                                        @if($disciplina->departamento == $departamento)

                                        <div class="panel-body">
                                            <p>    
                                                <span class="text-danger"><strong>{{ $disciplina->nome }}</strong></span><br>
                                                <span class="text-success">Requisitos: <strong>{{ $disciplina->requisitos }}</strong></span><br>
                                                <strong>Docente: </strong>{{ $disciplina->professor->nome }}<br>
                                            </p>
                                            <ul>
                                                @foreach($disciplina->turmas as $turma)
                                                @if($turma->vagas > 0)
                                                <div class="panel">
                                                    <li class="pull-left ">
                                                        <strong>Horário:</strong> {{ $turma->horario }}<br>
                                                        <span id="vagas{{$turma->id}}">
                                                            <strong>Vagas:</strong> {{ $turma->vagas }}
                                                        </span>
                                                    </li>
                                                    <div class="checkbox pull-right">
                                                        <input id="selecionaTurma{{ $turma->id }}" class="selecionaTurma" type="checkbox" name="selecionaTurma" value="{{ $turma->id }}" autocomplete="off" />Selecionar
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                @else
                                                <div class="panel">
                                                    <li class="pull-left ">
                                                        <strong>Horário:</strong> {{ $turma->horario }}<br>
                                                        <span id="vagas{{$turma->id}}">
                                                            <strong class="text-danger">Vagas esgotadas.</strong>
                                                        </span>
                                                    </li>
                                                </div>
                                                @endif
                                                @endforeach
                                            </ul>
                                        </div>

                                        <div class="panel-footer"></div>
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </div>
                        {{-- End of modal content --}}


                    </table>


                </div>
                <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                        <div class="btn-group" role="group">
                            <button type="button" id="salvaTurmas" class="btn btn-primary btn-hover-green" data-dismiss="modal" role="button">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim - Modal com as disciplinas e turmas -->

    <form method="post" action="{{url('candidatos')}}">
        {{csrf_field()}}
        <input type="hidden" id="turmasSelecionadas" name="turmasSelecionadas" autocomplete="off" value="{{ old('turmasSelecionadas') }}">
        <input type="hidden" id="filtroTurma" name="filtroTurma" value="">
        <fieldset>
            <legend>Dados pessoais</legend>
            <div class="form-group row">
                <!-- Nome -->
                <label for="nome" class="col-sm-2 col-form-label col-form-label-lg">Nome</label>
                <div class="col-sm-7">
                    <input type="text" autocomplete="off" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Nome" name="nome" value="{{ old('nome') }}">
                </div>
            </div>
            <div class="form-group row">
                <!-- RG -->
                <label for="rg" class="col-sm-2 col-form-label col-form-label-lg">RG</label>
                <div class="col-sm-4">
                    <input type="text" autocomplete="off" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="RG" name="rg" value="{{ old('rg') }}">
                </div>
            </div>
            <div class="form-group row">
                <!-- CPF -->
                <label for="cpf" class="col-sm-2 col-form-label col-form-label-lg">CPF</label>
                <div class="col-sm-4">
                    <input type="text" autocomplete="off" class="form-control form-control-lg cpf" id="lgFormGroupInput" placeholder="CPF" name="cpf" value="{{ old('cpf') }}">
                </div>
            </div>
            <div class="form-group row">
                <!-- E-mail -->
                <label for="email" class="col-sm-2 col-form-label col-form-label-lg">E-mail</label>
                <div class="col-sm-7">
                    <input type="text" autocomplete="off" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="E-mail" name="email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="form-group row">
                <!-- Data de nascimento -->
                <label for="data_nascimento" class="col-sm-2 col-form-label col-form-label-lg">Data de Nascimento</label>
                <div class="col-sm-4">
                    <input type="text" autocomplete="off" class="data-nascimento form-control form-control-lg date-field" id="lgFormGroupInput" placeholder="Data de nascimento" name="data_nascimento" value="{{ old('data_nascimento') }}">
                </div>
                <span id="alerta-idade" class="text-danger hidden">Você precisa ter o mínimo de 60 anos de idade para participar</span>
            </div>
            <div class="form-group row">
                <!-- Estado Civil -->
                
                <label for="estado_civil" class="col-sm-2 col-form-label col-form-label-lg">Estado Civil</label>
                <select name="estado_civil" class="selectpicker col-sm-4">
                    @if (Input::old('estado_civil') == 'Solteiro')
                    <option autocomplete="off" value="Solteiro" selected>Solteiro</option>
                    @else
                    <option autocomplete="off" value="Solteiro">Solteiro</option>
                    @endif
                    @if (Input::old('estado_civil') == 'Casado')
                    <option autocomplete="off" value="Casado" selected>Casado</option>
                    @else
                    <option autocomplete="off" value="Casado">Casado</option>
                    @endif
                    @if (Input::old('estado_civil') == 'Divorciado')
                    <option autocomplete="off" value="Divorciado" selected>Divorciado</option>
                    @else
                    <option autocomplete="off" value="Divorciado">Divorciado</option>
                    @endif
                    @if (Input::old('estado_civil') == 'Viúvo')
                    <option autocomplete="off" value="Viúvo" selected>Viúvo</option>
                    @else
                    <option autocomplete="off" value="Viúvo">Viúvo</option>
                    @endif
                    @if (Input::old('estado_civil') == 'Outro')
                    <option autocomplete="off" value="Outro" selected>Outro</option>
                    @else
                    <option autocomplete="off" value="Outro">Outro</option>
                    @endif
                </select>
            </div>
            <div class="form-group row">
                <!-- Escolaridade -->
                <label for="escolaridade" class="col-sm-2 col-form-label col-form-label-lg">Escolaridade</label>
                <select name="escolaridade" class="selectpicker col-sm-4" data-live-search="true">
                    @foreach($escolaridades as $escolaridade)
                        @if (Input::old('escolaridade') == $escolaridade->nome)
                        <option autocomplete="off" data-tokens="{{$escolaridade->nome}}" value="{{$escolaridade->nome}}" selected>{{$escolaridade->nome}}</option>
                        @else
                        <option autocomplete="off" data-tokens="{{$escolaridade->nome}}" value="{{$escolaridade->nome}}">{{$escolaridade->nome}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </fieldset>
        <fieldset>
            <legend>Dados de localiza&ccedil;&atilde;o</legend>
            <div class="form-group row">
                <!-- CEP -->
                <label for="cep" class="col-sm-2 col-form-label col-form-label-lg">CEP</label>
                <div class="col-sm-4">
                    <input autocomplete="off" type="text" class="cep form-control form-control-lg" id="cep" placeholder="CEP" name="cep" value="{{ old('cep') }}">
                </div>
            </div>
            <div class="form-group row">
                <!-- Endereço -->
                <label for="rua" class="col-sm-2 col-form-label col-form-label-lg">Rua</label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" class="rua form-control form-control-lg" id="rua" placeholder="Rua" name="rua" value="{{ old('rua') }}">
                </div>
            </div>
            <div class="form-group row">
                <!-- Número -->
                <label for="numero" class="col-sm-2 col-form-label col-form-label-lg">Número</label>
                <div class="col-sm-2">
                    <input autocomplete="off" type="text" class="numero form-control form-control-lg" id="numero" placeholder="Número" name="numero" value="{{ old('numero') }}">
                </div>
            </div>
            <div class="form-group row">
                <!-- Complemento -->
                <label for="complemento" class="col-sm-2 col-form-label col-form-label-lg">Complemento</label>
                <div class="col-sm-2">
                    <input autocomplete="off" type="text" class="complemento form-control form-control-lg" id="complemento" placeholder="Complemento" name="complemento" value="{{ old('complemento') }}">
                </div>
            </div>
            <div class="form-group row">
                <!-- Bairro -->
                <label for="bairro" class="col-sm-2 col-form-label col-form-label-lg">Bairro</label>
                <div class="col-sm-7">
                    <input autocomplete="off" type="text" class="bairro form-control form-control-lg" id="bairro" placeholder="Bairro" name="bairro" value="{{ old('bairro') }}">
                </div>
            </div>
            <div class="form-group row">
                <!-- Cidade -->
                <label for="cidade" class="col-sm-2 col-form-label col-form-label-lg">Cidade</label>
                <div class="col-sm-7">
                    <input type="text" autocomplete="off" class="cidade form-control form-control-lg" id="cidade" placeholder="Cidade" name="cidade" value="{{ old('cidade') }}">
                </div>
            </div>
            <div class="form-group row">
                <!-- UF -->
                <label for="uf" class="col-sm-2 col-form-label col-form-label-lg">UF</label>
                <div class="col-sm-7">
                    <input type="text" autocomplete="off" maxlength="2" class="uf form-control form-control-lg" id="uf" placeholder="UF" name="uf" value="{{ old('uf') }}">
                </div>
            </div>
            <div class="form-group row">
                <!-- Telefone -->
                <label for="telefone" class="col-sm-2 col-form-label col-form-label-lg">Telefone</label>
                <div class="col-sm-4">
                    <input type="text" autocomplete="off" class=" telefone form-control form-control-lg" id="lgFormGroupInput" placeholder="Telefone" name="telefone" value="{{ old('telefone') }}">
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Pesquisa</legend>
            <div class="form-group row">
                <!-- Como soube? -->
                <label for="como_soube" class="col-sm-2 col-form-label col-form-label-lg">Como soube</label>
                <div class="col-sm-7">
                    <label class="radio">
                        <input type="radio" autocomplete="off" name="como_soube" id="como_soube_opcao1" value="Site da PRCEU" @if(old('como_soube') == "Site da PRCEU") checked @endif> Site da PRCEU
                    </label>
                    <label class="radio">
                        <input type="radio" autocomplete="off" name="como_soube" id="como_soube_opcao2" value="Site do Programa A Universidade Aberta à Terceira Idade" @if(old('como_soube') == "Site do Programa A Universidade Aberta à Terceira Idade") checked @endif> Site do Programa A Universidade Aberta à Terceira Idade
                    </label>
                    <label class="radio">
                        <input type="radio" autocomplete="off" name="como_soube" id="como_soube_opcao3" value="Site da Faculdade Unidade Campus" @if(old('como_soube') == "Site da Faculdade Unidade Campus") checked @endif> Site da Faculdade/ Unidade/ Campus
                    </label>
                    <label class="radio">
                        <input type="radio" autocomplete="off" name="como_soube" id="como_soube_opcao4" value="Facebook" @if(old('como_soube') == "Facebook") checked @endif> Facebook
                    </label>
                    <label class="radio">
                        <input type="radio" autocomplete="off" name="como_soube" id="como_soube_opcao5" value="Google" @if(old('como_soube') == "Google") checked @endif> Google
                    </label>
                    <label class="radio">
                        <input type="radio" autocomplete="off" name="como_soube" id="como_soube_opcao6" value="Cartaz, faixa, panfleto" @if(old('como_soube') == "Cartaz, faixa, panfleto") checked @endif> Cartaz, faixa, panfleto
                    </label>
                    <label class="radio">
                        <input type="radio" autocomplete="off" name="como_soube" id="como_soube_opcao7" value="TV" @if(old('como_soube') == "TV") checked @endif> TV
                    </label>
                    <label class="radio">
                        <input type="radio" autocomplete="off" name="como_soube" id="como_soube_opcao8" value="Radio" @if(old('como_soube') == "Radio") checked @endif> Rádio
                    </label>
                    <label class="radio">
                        <input type="radio" autocomplete="off" name="como_soube" id="como_soube_opcao9" value="Outros" @if(old('como_soube') == "Outros") checked @endif> Outros
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <!-- Transporte -->
                <label for="disponibilidade_transporte" class="col-sm-2 col-form-label col-form-label-lg">Disponibilidade de transporte</label>
                <div class="col-sm-7">
                    <label class="radio-inline">
                        <input type="radio" autocomplete="off" name="disponibilidade_transporte" id="disponibilidade_transporte_opcao1" value="Onibus" @if(old('disponibilidade_transporte') == "Onibus") checked @endif> Ônibus
                    </label>
                    <label class="radio-inline">
                        <input type="radio" autocomplete="off" name="disponibilidade_transporte" id="disponibilidade_transporte_opcao2" value="Carro" @if(old('disponibilidade_transporte') == "Carro") checked @endif> Carro
                    </label>
                    <label class="radio-inline">
                        <input type="radio" autocomplete="off" name="disponibilidade_transporte" id="disponibilidade_transporte_opcao3" value="Outro" @if(old('disponibilidade_transporte') == "Outro") checked @endif> Outro
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <!-- Refeição -->
                <label for="necessita_refeicao" class="col-sm-2 col-form-label col-form-label-lg">Necessitará de refeição no dia da aula</label>
                <div class="col-sm-7">
                    <label class="radio-inline">
                        <input type="radio" autocomplete="off" name="necessita_refeicao" id="necessita_refeicao_opcao1" value="Sim" @if(old('necessita_refeicao') == "Sim") checked @endif> Sim
                    </label>
                    <label class="radio-inline">
                        <input type="radio" autocomplete="off" name="necessita_refeicao" id="necessita_refeicao_opcao2" value="Nao" @if(old('necessita_refeicao') == "Nao") checked @endif> Não
                    </label>
                    <label class="radio-inline">
                        <input type="radio" autocomplete="off" name="necessita_refeicao" id="necessita_refeicao_opcao3" value="Irá trazer refeição/lanche" @if(old('necessita_refeicao') == "Irá trazer refeição/lanche") checked @endif> Irá trazer refeição/lanche
                    </label>
                    <label class="radio-inline">
                        <input type="radio" autocomplete="off" name="necessita_refeicao" id="necessita_refeicao_opcao4" value="Utilizará lanchonete" @if(old('necessita_refeicao') == "Utilizará lanchonete") checked @endif> Utilizará lanchonete
                    </label>
                    <label class="radio-inline">
                        <input type="radio" autocomplete="off" name="necessita_refeicao" id="necessita_refeicao_opcao5" value="Outros" @if(old('necessita_refeicao') == "Outros") checked @endif> Outros
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <!-- Atividades na área -->
                <label for="atividades_profissionais" class="col-sm-2 col-form-label col-form-label-lg">Atividades profissionais já desenvolvidas:</label>
                <div class="col-sm-7">
                    <textarea autocomplete="off" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Atividades profissionais já desenvolvidas" name="atividades_profissionais">{{ old('atividades_profissionais') }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <!-- Motivo de interesse -->
                <label for="motivo_interesse" class="col-sm-2 col-form-label col-form-label-lg">Por que se interessou pelo Projeto?</label>
                <div class="col-sm-7">
                    <textarea autocomplete="off" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Por que se interessou pelo Projeto?" name="motivo_interesse">{{ old('motivo_interesse') }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <!-- Observações -->
                <label for="observacoes" class="col-sm-2 col-form-label col-form-label-lg">Observações</label>
                <div class="col-sm-7">
                    <textarea autocomplete="off" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Observações" name="observacoes">{{ old('observacoes') }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <!-- Observações -->
                <label for="termo_responsabilidade" class="col-sm-2 col-form-label col-form-label-lg">Termo de responsabilidade</label>
                <div class="col-sm-7">
                    <input autocomplete="off" class="termo_responsabilidade" type="checkbox" name="termo_responsabilidade" @if(old('termo_responsabilidade') == true) checked @endif />Declaro que as informações acima são verdadeiras e estou ciente dos requisitos necessários para a matrícula.
                </div>
            </div>
        </fieldset>
        <div class="form-group row">
            <div class="col-md-2"></div>
            <input type="submit" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection
