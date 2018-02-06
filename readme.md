<p align="center">
  <img src="http://prceu.usp.br/3idade/wp-content/uploads/2017/05/logo_UATIvertical_cor.png" width="150px" alt="Logo UATI" />
  <img src="http://prceu.usp.br/wp-content/uploads/2015/01/marca_horizontal_PRCEU_sfundo.png" width="300px" alt="Logo PRCEU-USP" />
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
- cp .env.example .env
	- Ajustar o .env com os dados do seu banco de dados
		- Assumindo que o banco já tenha sido criado
	- Setar as variáveis ANO e SEMESTRE
- php artisan key:generate
- php artisan config:cache
- composer install
- php artisan migrate
- **Não implementado (issue aberta)**: php artisan db:seed
- php artisan serve
	- Acessar http://localhost:8000 no navegador

## Contribua

Existem várias formas de contribuir no projeto, e todas são muito bem vindas.

