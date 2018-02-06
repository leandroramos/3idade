<p align="center">
  ![Logo USP](http://prceu.usp.br/3idade/wp-content/themes/eceu_claro/img/logo-usp.svg)
  ![Logo UATI](http://prceu.usp.br/3idade/wp-content/uploads/2017/05/logo_UATIvertical_cor.png)
  ![Logo PRCEU](http://prceu.usp.br/wp-content/uploads/2015/01/marca_assinatura_PRCEU_azul_sfundo.png)
</p>
# Programa Universidade Aberta à Terceira Idade

## Sobre o sistema

Sistema de matrículas no programa Universidade Aberta à Terceira Idade, concebido para facilitar o processo para os candidatos e para o pessoal da CCEX da unidade.

## Dependências

- PHP >= 5.6.4
- **[Composer](https://getcomposer.org/)**
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Deploy

- git clone git@github.com:uspdev/3idade.git
- cd 3idade
- composer install
- php artisan migrate
- php artisan serve
	- Acessar http://localhost:8000 no navegador