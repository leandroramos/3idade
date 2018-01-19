<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="SCDATEC - SVTI/ECA">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/print.css') }}" media="print" rel="stylesheet">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
            <img class="pull-left" width="80px" src="{{ asset('images/logo-eca.png') }}">
            <span>&nbsp;&nbsp;Universidade Aberta &agrave; Terceira Idade<span>
          </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>   
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        
        
        <!-- Content beginning -->
        
        <div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-2 main">
          @yield('content')
        </div>
        <!-- Content ending -->
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <!--<script src="../../assets/js/vendor/holder.min.js"></script>-->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/i18n/defaults-*.min.js"></script>
  </body>
  <script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(function () {

        function limpa_formulario_cep() {
            // Limpa valores do formulário de cep.
            $(".rua").val("");
            $(".numero").val("");
            $(".bairro").val("");
            $(".cidade").val("");
            $(".uf").val("");
        }

        //Quando o campo cep perde o foco.
        $(".cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $(".rua").val("...");
                    $(".bairro").val("...");
                    $(".cidade").val("...");
                    $(".uf").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $(".rua").val(dados.logradouro);
                            $(".bairro").val(dados.bairro);
                            $(".cidade").val(dados.localidade);
                            $(".uf").val(dados.uf);
                            $('.numero').focus();
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });

        $('.cep').mask('99999-999');
        $('.date-field').mask('99/99/9999');
        $('.telefone')
        .mask("(99) 9999-9999?9")
        .focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();  
            if(phone.length > 10) {  
                element.mask("(99) 99999-999?9");  
            } else {  
                element.mask("(99) 9999-9999?9");  
            }  
        });
        $('.datepicker-container input').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR"
        });

        $('.data-nascimento').blur(function() {
            function idade(ano_aniversario, mes_aniversario, dia_aniversario) {
                var d = new Date,
                ano_atual = d.getFullYear(),
                mes_atual = d.getMonth() + 1,
                dia_atual = d.getDate(),

                ano_aniversario = +ano_aniversario,
                mes_aniversario = +mes_aniversario,
                dia_aniversario = +dia_aniversario,

                quantos_anos = ano_atual - ano_aniversario;

                if (mes_atual < mes_aniversario || mes_atual == mes_aniversario && dia_atual < dia_aniversario) {
                    quantos_anos--;
                }

                return quantos_anos < 60 ? false : true;
            }

            var aniversario = $(this).val().split('/');
            var dia_aniversario = aniversario[0];
            var mes_aniversario = aniversario[1];
            var ano_aniversario = aniversario[2];

            if (!idade(ano_aniversario, mes_aniversario, dia_aniversario)) {
                $('#alerta-idade').removeClass('hidden');
                //$(this).val('');
                $(this).focus();
            } else {
                $('#alerta-idade').removeClass('hidden');
                $('#alerta-idade').addClass('hidden');
            }



        });

        /*
         * Datatables
         */
        // $('.table').DataTable({
        //     stateSave: true
        // });
        // 
        
        /*
         * Verifica o máximo de disciplinas
         */
        $('input.selecionaTurma').click(function(){
            if ($('.selecionaTurma:checked').length > 2) {
                alert('Você deve selecionar no máximo duas turmas.');
                return false;
            }
        });
        // $('#salvaTurmas').click(function(){
        //     $('#turmasSelecionadas').val('');
        //     $('.selecionaTurma:checked').each(function(){

        //         $('#turmasSelecionadas').val($('#turmasSelecionadas').val() + '-' + $(this).val());
        //     });
        // });
        
        $('#salvaTurmas').click(function(){
            $('#turmasSelecionadas').val('');
            $('.selecionaTurma:checked').each(function(){
                var id = $(this).val();
                $.ajax({

                    method: "POST",
                    url: 'http://www2.eca.usp.br/3idade/turmas/verifica/' + id,
                    //url: 'http://localhost:8000/turmas/verifica/' + id,
                    success: function (data) {
                        if (data > 0) {
                            $('#turmasSelecionadas').val($('#turmasSelecionadas').val() + '-' + id);
                        } else {
                            alert('A turma selecionada não está mais disponível.');
                            $('#selecionaTurma'+id).hide;
                            $('#selecionaTurma'+id).prop('checked', false);
                            $('#vagas'+id).html("<strong class='text-danger'>Vagas esgotadas.</strong>");
                        }
                    },
                    error: function (data) {
                        alert('Erro:', data);
                    }
                });
            });
        });
    });
  </script>
</html>
