@extends('layouts.app')

@section('title', 'Horários')

@section('sidebar')
    @parent
@endsection

@section('content')
<h1 class="page-header">Dashboard</h1>
<h2 class="sub-header">Hor&acute;rios</h2>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Dia da Semana</th>
      <th>Hora Início</th>
      <th>Hora Fim</th>
      <th>Disciplina</th>
    </tr>
  </thead>
  <tbody>
  @foreach($horarios as $key => $value)
    <tr>
      <td>{{ $value->id }}</td>
      <td>{{ $value->dia_semana }}</td>
      <td>{{ $value->hora_inicio }}</td>
      <td>{{ $value->hora_fim }}</td>
      <td>{{ $value->disciplina_id }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection
