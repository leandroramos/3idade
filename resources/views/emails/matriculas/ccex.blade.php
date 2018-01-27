<!DOCTYPE html>
<html>
<head>
	<title>Matrícula efetuada</title>
	<meta charset="utf-8">
	<style>
	    body{
	        width:510px;
	        margin:0;
	        padding:0 20px;
	        font-family:"Raleway", sans-serif;
	        font-size:12px;
	    }
	    h1{
	        font-size:20px;
	    }
	    h2{
	        font-size:16px;
	    }
	</style>
</head>
<body>
<h1>
    <a href="http://www3.eca.usp.br" title="Escola de Comunicações e Artes">
        <img alt="ECA - Escola de Comunicações e Artes da USP" align="left" src="http://www3.eca.usp.br/sites/default/themes/eca_032013/images/logo-eca_032013.png">
    </a>
    <a href="http://www5.usp.br/" title="Universidade de São Paulo">
        <img alt="Universidade de São Paulo" align="right" src="http://www3.eca.usp.br/sites/default/themes/eca_032013/images/logo-usp_032013.png">
    </a>
    <div style="clear:both"></div>
</h1>
<hr>
<h2>
     Universidade Aberta à Terceira Idade
</h2>
<h3>O sistema recebeu uma matrícula</h3>
<p>
	O candidato <strong>{{ $candidato->nome }}</strong> enviou uma ficha de matrícula em {{ date('d/m/Y à\s H:i:s', strtotime($ficha->created_at)) }}, com os seguintes dados:
</p>
<hr>
<p>
	<strong>Nome:</strong> {{$candidato->nome}}<br>
	<strong>E-mail:</strong> {{$candidato->email}}<br>
	<strong>RG:</strong></strong> {{$candidato->rg}}<br>
    <strong>CPF:</strong> {{$candidato->cpf}}<br>
	<strong>Data de nascimento:</strong> {{$candidato->data_nascimento}}<br>
	<strong>Telefone:</strong> {{$candidato->telefone}}
<p>	
	<strong>CEP:</strong> {{$candidato->endereco->cep}}<br>
	<strong>Logradouro:</strong> {{$candidato->endereco->rua}} nº {{$candidato->endereco->numero}} {{$candidato->endereco->complemento}}<br>
	<strong>Bairro:</strong> {{$candidato->endereco->bairro}}<br>
	<strong>Cidade:</strong> {{$candidato->endereco->cidade}}<br>
	<strong>Estado:</strong> {{$candidato->endereco->uf}}<br>
</p>
<p>
	<strong>Disciplinas:</strong>
</p>
<div id="disciplinas-escolhidas">
    <ul>
        @foreach($disciplinas as $disciplina)
        <li>
            <span class="text-primary"><strong>{{ $disciplina->nome }}</strong></span><br>
            Requisitos: <span class="text-danger"><strong>{{ $disciplina->requisitos }}</strong></span><br>
            Horário:  
            @foreach($turmas as $turma)
                @foreach($disciplina->turmas as $disciplina_turma)
                    @if($disciplina_turma->id == $turma->id)
                    {{ $turma->horario }}
                    @endif
                @endforeach
            @endforeach
            <br>
            Professor respons&aacute;vel: <strong>{{ $disciplina->professor->nome }}</strong>
        </li>
        @endforeach
    </ul>
</div>
<hr>
<div>
    <p><strong>Respostas à pesquisa:</strong></p>
    <p><strong>Como soube:</strong><br>{{ $candidato->pesquisa->como_soube }}</p>
    <p><strong>Necessita refeição:</strong><br>{{ $candidato->pesquisa->necessita_refeicao }}</p>
    <p><strong>Atividades profissionais desenvolvidas:</strong><br>{{ $candidato->pesquisa->atividades_profissionais }}</p>
    <p><strong>Motivo do interesse:</strong><br>{{ $candidato->pesquisa->motivo_interesse }}</p>
    <p><strong>Observações:</strong><br>{{ $candidato->pesquisa->observacoes }}</p>
</div>
<hr>
<div>
	<p>
		Os dados estão disponíveis no link da 
		<a href="http://www2.eca.usp.br/3idade/fichas/{{encrypt($candidato->id)}}" title="Ficha do candidato">
			Ficha do candidato
		</a>
	</p>
	<p>
		A lista de todos os candidatos pode ser vista no link da
		<a href="http://www2.eca.usp.br/3idade/candidatos" title="Ficha do candidato">
			Página dos candidatos
		</a>
	</p>
</div>
<hr>
<div>
    <p>
        <a href="http://www3.eca.usp.br/ccex" title="Comissão de Cultura e Extensão Universitária da ECA">
        {{-- <img width="150px" src="http://www3.eca.usp.br/sites/default/files/form/cultext/logoccex%20transparente.png"><br> --}}
        Comissão de Cultura e Extensão Universitária da ECA
        </a>
        <br>
        Av. Prof. Lúcio Martins Rodrigues, 443<br>
        Cidade Universitária – CEP 05508-020<br>
        São Paulo – SP – Brasil<br>
        Tel.: 55 11 3091-4067
    </p>
</div>
</body>
</html>	