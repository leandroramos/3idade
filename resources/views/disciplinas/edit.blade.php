@extends('layouts.app')

@section('title', 'Disciplinas')

@section('sidebar')
@parent
@endsection

@section('content')
<h1 class="page-header">Administra&ccedil;&atilde;o do Sistema</h1>
<h2 class="sub-header">Disciplinas</h2>
<div class="container">
    <form method="post" action="{{action('DisciplinaController@update', $disciplina->id)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-group row">
            <!-- Departamento -->
            <label for="departamento" class="col-sm-2 col-form-label col-form-label-lg">Departamento</label>
            <select name="departamento" class="selectpicker col-sm-4">
                @foreach($departamentos as $departamento)
                <option data-tokens="{{$departamento}}" value="{{$departamento}}">{{$departamento}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <!-- Nome da disciplina -->
            <label for="nome" class="col-sm-2 col-form-label col-form-label-lg">Nome da disciplina</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Nome da disciplina" name="nome" value="{{ $disciplina->nome }}">
            </div>
        </div>
        <div class="form-group row">
            <!-- Pré-requisitos -->
            <label for="requisitos" class="col-sm-2 col-form-label col-form-label-lg">Pré-requisitos</label>
            <div class="col-sm-7">
                <textarea class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Pré-requisitos" name="requisitos">{{ $disciplina->requisitos }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <!-- Professor -->
            <label for="professor" class="col-sm-2 col-form-label col-form-label-lg">Professor</label>
            <select name="professor_id" class="selectpicker col-sm-4" data-live-search="true">
                @foreach($professores as $professor)
                <option data-tokens="{{$professor->nome}}" value="{{$professor->id}}">{{$professor->nome}}</option>
                @endforeach
            </select>
        </div>
        <fieldset>
            <legend>Turmas</legend>
            <div class="form-group row">
                <!-- Horário -->
                <label for="horario" class="col-sm-2 col-form-label col-form-label-lg">Hor&aacute;rio</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Horário" name="horario">
                </div>
            </div>
            <div class="form-group row">
                <!-- Vagas -->
                <label for="vagas" class="col-sm-2 col-form-label col-form-label-lg">Número de vagas</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="vagas" name="vagas" value="{{ $disciplina->vagas }}">
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
