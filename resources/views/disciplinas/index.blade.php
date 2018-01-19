@extends('layouts.app')

@section('title', 'Disciplinas')

@section('sidebar')
@parent
@endsection

@section('content')
<h1 class="page-header">Administra&ccedil;&atilde;o do Sistema</h1>
<h2 class="sub-header">Disciplinas</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Vagas</th>
                <th>Requisitos</th>
                <th>Professor Responsável</th>
                <th colspan="2">A&ccedil;&otilde;es</th>
            </tr>
        </thead>
        <tbody>
            @foreach($disciplinas as $disciplina)
            <tr>
                <td>{{ $disciplina->id }}</td>
                <td>{{ $disciplina->nome }}</td>
                <td>{{ $disciplina->vagas }}</td>
                <td>{{ $disciplina->requisitos }}</td>
                <td>{{ $disciplina->professor_id }}</td>
                <td><a href="{{action('DisciplinaController@edit', $disciplina['id'])}}" class="btn btn-warning">Editar</a></td>
                <td>
                    <form action="{{action('DisciplinaController@destroy', $disciplina['id'])}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
