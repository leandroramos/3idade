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
<h3>Sua matrícula foi efetuada.</h3>
<p>
	<strong>{{ $candidato->nome }}</strong>,<br>
	Você se matriculou na Universidade Aberta à Terceira Idade em {{ date('d/m/Y à\s H:i:s', strtotime($ficha->created_at)) }}, no segundo semestre de 2017. Por favor, entre em contato com a Comissão de Cultura e Extensão Universitária da ECA, respondendo a este e-mail ou pelo telefone <strong>(11) 3091-4067</strong>.<br>
	Seguem os dados de sua matrícula:
</p>
<hr>
<p>
	Nome: {{$candidato->nome}}<br>
	E-mail: {{$candidato->email}}<br>
	RG: {{$candidato->rg}}<br>
	Data de nascimento: {{$candidato->data_nascimento}}<br>
	Telefone: {{$candidato->telefone}}
<p>	
	CEP: {{$candidato->endereco->cep}}<br>
	Logradouro: {{$candidato->endereco->rua}} nº {{$candidato->endereco->numero}} {{$candidato->endereco->complemento}}<br>
	Bairro: {{$candidato->endereco->bairro}}<br>
	Cidade: {{$candidato->endereco->cidade}}<br>
	Estado: {{$candidato->endereco->uf}}<br>
</p>
<p>
	Disciplinas:
</p>
<ul>
@foreach($disciplinas as $disciplina)
	<li>
		<strong>{{ $disciplina->nome }}</strong><br>
		<strong>Requisitos:</strong> {{ $disciplina->requisitos }}<br>
		<strong>Horário: </strong>{{ $disciplina->turmas[0]->horario }}<br>
		<strong>Professor responsável: </strong>{{ $disciplina->professor->nome }}
	</li>
@endforeach
</ul>
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