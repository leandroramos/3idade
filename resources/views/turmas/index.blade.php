@extends('layouts.app')

@section('title', 'Disciplinas')

@section('sidebar')
@parent
@endsection

@section('content')
<h1 class="page-header">Administra&ccedil;&atilde;o do Sistema</h1>
<h2 class="sub-header">Disciplinas</h2>
<div class="table-responsive">
{{-- {{ dd($turmas[0]->turmas) }} --}}
    <table id="lista-dados" class="table table-striped">
        <thead>
            <tr>
                <th>Disciplina</th>
                <th>Horário</th>
                <th>Vagas</th>
                <th>Requisitos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($turmas as $turma)
                @foreach($turma->turmas as $turma_turma)
                <tr>
                    <td>{{ $turma->nome }}</td>
                    <td>{{ $turma_turma->horario }}</td>
                    <td>
                    @if ($turma_turma->vagas <= 0)
                        <span class="text-danger"><strong>{{ $turma_turma->vagas }}</strong></span>
                    @else
                        <span class="text-success"><strong>{{ $turma_turma->vagas }}</strong></span>
                    @endif
                    </td>
                    <td>{{ $turma->requisitos }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
@endsection
