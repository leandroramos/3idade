<?php use Illuminate\Support\Facades\Input; ?>
@extends('layouts.app')

@section('title', 'Disciplinas')

@section('sidebar')
@parent
@endsection

@section('content')
<h1 class="page-header">Administra&ccedil;&atilde;o do Sistema</h1>
<h2 class="sub-header">Disciplinas</h2>
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
    
    <form method="post" action="{{url('disciplinas')}}">
        {{csrf_field()}}
        <div class="form-group row">
            <!-- Ano e semestre -->
            <label for="ano" class="col-sm-2 col-form-label col-form-label-lg">Ano</label>
            <div class="col-sm-2">
                <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" value="{{ env('ANO') }}" name="ano">
            </div>
        </div>
        <div class="form-group row">
            <label for="semestre" class="col-sm-2 col-form-label col-form-label-lg">Semestre</label>
            <select name="semestre" class="selectpicker col-sm-2">
                @if (Input::old('semestre') == '1')
                <option autocomplete="off" value="1" selected>1</option>
                @else
                <option autocomplete="off" value="1">1</option>
                @endif
                @if (Input::old('semestre') == '2')
                <option autocomplete="off" value="2" selected>2</option>
                @else
                <option autocomplete="off" value="2">2</option>
                @endif
            </select>
        </div>
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
                <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Nome da disciplina" name="nome">
            </div>
        </div>
        <div class="form-group row">
            <!-- Pré-requisitos -->
            <label for="requisitos" class="col-sm-2 col-form-label col-form-label-lg">Pré-requisitos</label>
            <div class="col-sm-7">
                <textarea class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Pré-requisitos" name="requisitos"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <!-- Professor -->
            <label for="professor_id" class="col-sm-2 col-form-label col-form-label-lg">Professor</label>
            <select name="professor_id" class="selectpicker col-sm-4" data-live-search="true">
                @foreach($professores as $professor)
                <option data-tokens="{{$professor->nome}}" value="{{$professor->id}}">{{$professor->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group row">
            <div class="col-md-2"></div>
            <input type="submit" class="btn btn-primary">
        </div>

    </form>
</div>
@endsection
