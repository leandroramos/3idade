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
        <a href="{{action('CandidatoController@destroy', encrypt($candidato['candidato']['id']))}}" class="btn btn-danger">Excluir</a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection
