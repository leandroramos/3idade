@extends('layouts.app')

@section('title', 'Horários')

@section('sidebar')
    @parent
@endsection

@section('content')
<h1 class="page-header">Dashboard</h1>
<h2 class="sub-header">Escolaridades</h2>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Nome</th>
    </tr>
  </thead>
  <tbody>
  @foreach($escolaridades as $key => $value)
    <tr>
      <td>{{ $value->id }}</td>
      <td>{{ $value->nome }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection
