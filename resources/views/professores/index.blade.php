@extends('layouts.app')

@section('title', 'Professores')

@section('sidebar')
    @parent
@endsection

@section('content')
<h1 class="page-header">Dashboard</h1>
<h2 class="sub-header">Professores</h2>
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
  <a href="{{ route('professores.create') }}" class="btn btn-success">Adicionar professor</a>
<p>
<div class="table-responsive">
  <table id="lista-dados" class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Editar</th>
        <th>Deletar</th>
      </tr>
    </thead>
    <tbody>
    @foreach($professores as $key => $value)
      <tr>
        <td>{{ $value->id }}</td>
        <td>{{ $value->nome }}</td>
        <td>
          <a href="{{action('ProfessorController@edit', $value->id)}}" class="btn btn-warning">Editar</a>
        </td>
        <td>
          <form action="{{action('ProfessorController@destroy', $value->id)}}" method="post">
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
