@extends('layouts.app')

@section('title', 'Disciplinas')

@section('sidebar')
    @parent
@endsection

@section('content')
<h1 class="page-header">Dashboard</h1>
<h2 class="sub-header">Disciplinas</h2>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Nome</th>
    </tr>
  </thead>
  <tbody>
  @foreach($professores as $key => $value)
    <tr>
      <td>{{ $value->id }}</td>
      <td>{{ $value->nome }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection
