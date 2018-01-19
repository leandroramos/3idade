@extends('layouts.app')

@section('title', 'Pesquisas')

@section('sidebar')
    @parent
@endsection

@section('content')
<h1 class="page-header">Dashboard</h1>
<h2 class="sub-header">Pesquisas</h2>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Como soube?</th>
      <th>Disponibilidade de transporte</th>
      <th>Necessita refeição?</th>
      <th>Atividades profissionais</th>
      <th>Motivo do interesse</th>
      <th>Observa&ccedil;&otilde;es</th>
    </tr>
  </thead>
  <tbody>
  @foreach($pesquisas as $key => $value)
    <tr>
      <td>{{ $value->id }}</td>
      <td>{{ $value->como_soube }}</td>
      <td>{{ $value->disponibilidade_transporte }}</td>
      <td>{{ $value->necessita_refeicao }}</td>
      <td>{{ $value->atividades_profissionais }}</td>
      <td>{{ $value->motivo_interesse }}</td>
      <td>{{ $value->observacoes }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection
