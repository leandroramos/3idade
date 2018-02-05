@extends('layouts.app')

@section('title', 'Candidatos')

@section('sidebar')
    @parent
@endsection

@section('content')
<h1 class="page-header">Administração do Sistema</h1>
<h2 class="sub-header">Alunos</h2>
@foreach($departamentos as $departamento)
<h3>{{ $departamento }}</h3>
<?php $disciplinasDepartamento = []; ?>
<ul>
	@foreach($candidatos as $candidato)
		@foreach($candidato['disciplinas'] as $disciplina)
		@if($disciplina->departamento == $departamento)
			<?php array_push($disciplinasDepartamento, $disciplina->nome); ?>
		@endif
		@endforeach
	@endforeach

	<?php sort($disciplinasDepartamento); ?>
	<?php $disciplinasDepartamento = array_unique($disciplinasDepartamento); ?>

	@foreach($disciplinasDepartamento as $disciplinaDepartamento)
		<li><strong><span class="text-primary">{{ $disciplinaDepartamento }}</span></strong>
			<ul>
			@foreach($candidatos as $candidato)
				@foreach($candidato['disciplinas'] as $disciplina)

						@if($disciplina->nome == $disciplinaDepartamento)
						
							<li>
								{{ mb_convert_case(strtolower($candidato['candidato']->nome), MB_CASE_TITLE) }}<br>
                                E-mail: {{ $candidato['candidato']->email }}<br>
                                Telefone: {{ $candidato['candidato']->telefone }}
                                @foreach($candidato['turmas'] as $turma)

                                    @if($turma->disciplina_id == $disciplina->id)
                                        <p>Horário: {{ $turma->horario }}</p>
                                    @endif
                                @endforeach
							</li>
						@endif
					

				@endforeach
			@endforeach
			</ul>
		</li>
	@endforeach

</ul>

@endforeach

@endsection
