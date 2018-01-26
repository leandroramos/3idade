<?php use Illuminate\Support\Facades\Input; ?>
@extends('layouts.app')

@section('title', 'Professores')

@section('sidebar')
@parent
@endsection

@section('content')
<h1 class="page-header">Administra&ccedil;&atilde;o do Sistema</h1>
<h2 class="sub-header">Professores</h2>
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
    
    <form method="post" action="{{url('professores')}}">
        {{csrf_field()}}
        <div class="form-group row">
            <!-- Nome do professor -->
            <label for="nome" class="col-sm-2 col-form-label col-form-label-lg">Nome do professor</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="Nome do professor" name="nome">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-2"></div>
            <input type="submit" class="btn btn-primary">
        </div>

    </form>
</div>
@endsection
