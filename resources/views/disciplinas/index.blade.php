@extends('layouts.app')

@section('title', 'Disciplinas')

@section('sidebar')
@parent
@endsection

@section('content')
<h1 class="page-header">Administra&ccedil;&atilde;o do Sistema</h1>
<h2 class="sub-header">Disciplinas</h2>
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

<p>
  <a href="{{ route('disciplinas.create') }}" class="btn btn-success">Adicionar disciplina</a>
<p>
<div class="table-responsive">
    <table id="lista-dados" class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Vagas</th>
                <th>Requisitos</th>
                <th>Professor Responsável</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($disciplinas as $disciplina)
            <tr>
                <td>{{ $disciplina->id }}</td>
                <td>{{ $disciplina->nome }}</td>
                <td>{{ $disciplina->vagas }}</td>
                <td>{{ $disciplina->requisitos }}</td>
                <td>{{ $disciplina->professor->nome }}</td>
                <td><a href="{{action('DisciplinaController@edit', $disciplina['id'])}}" class="btn btn-warning">Editar</a></td>
                <td>
                    <form action="{{action('DisciplinaController@destroy', $disciplina['id'])}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="delete-item btn btn-danger" type="submit">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
