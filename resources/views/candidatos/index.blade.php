@extends('layouts.app')

@section('title', 'Candidatos')

@section('sidebar')
    @parent
@endsection

@section('content')
{{-- {{ dd($candidatos[0]) }} --}}
{{-- {{ dd($candidatos[0]['candidato']) }} --}}
{{-- {{ dd($candidatos[0]['turmas']) }} --}}
{{-- {{ dd($candidatos[0]['ficha']) }} --}}
{{-- {{ dd($candidatos[0]['disciplinas'][1]['turmas']) }} --}}
{{-- {{ dd($candidatos[0]['turmas'][0]['horario']) }} --}}
{{-- {{ dd($candidatos[0]['disciplinas'][0]) }} --}}
<h1 class="page-header">Administração do Sistema</h1>
<h2 class="sub-header">Candidatos</h2>

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

<div class="table-responsive">
<table id="lista-dados" class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Nome</th>
      <th>E-mail</th>
      <th>Telefone</th>
      <th>Turmas</th>
      <th>A&ccedil;&otilde;es</th>
    </tr>
  </thead>
  <tbody>
  @foreach($candidatos as $candidato)
    <tr>
      <td>{{ $candidato['candidato']['id'] }}</td>
      <td>{{ $candidato['candidato']['nome'] }}</td>
      <td>{{ $candidato['candidato']['email'] }}</td>
      <td>{{ $candidato['candidato']['telefone'] }}</td>
      <td>
        <ul>
        
        @foreach($candidato['disciplinas'] as $disciplina)
          <li>
              <span class="text-primary"><strong>{{ $disciplina['nome'] }}</strong></span><br>
              Requisitos: <span class="text-danger"><strong>{{ $disciplina['requisitos'] }}</strong></span><br>
              Horário:  
              @foreach($candidato['turmas'] as $turma)
                  @foreach($disciplina['turmas'] as $disciplina_turma)
                      @if($disciplina_turma['id'] == $turma->id)
                      {{ $turma->horario }}
                      @endif
                  @endforeach
              @endforeach
          </li>
        @endforeach

        </ul>

      </td>
      <td>
        <a href="{{action('FichaController@show', encrypt($candidato['candidato']['id']))}}" class="btn btn-success">Ver Ficha</a>
        <form action="{{ URL::route('candidatos.destroy', encrypt($candidato['candidato']['id'])) }}" method="POST">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button class="delete-item btn btn-danger">Excluir</button>
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection
