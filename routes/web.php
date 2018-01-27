<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('encerrado'); // Rota para inscrições encerradas
// });

Route::get('/', 'CandidatoController@create')->name('candidato');

Route::post('/turmas/verifica/{id}','TurmaController@verificaVagas');

Route::resource('disciplinas', 'DisciplinaController');
Route::resource('candidatos', 'CandidatoController');
Route::resource('enderecos', 'EnderecoController');
Route::resource('escolaridades', 'EscolaridadeController');
Route::resource('horarios', 'HorarioController');
Route::resource('pesquisas', 'PesquisaController');
Route::resource('professores', 'ProfessorController', ['parameters' => [
    'professores' => 'professor',
]]);
Route::resource('fichas', 'FichaController');
Route::resource('turmas', 'TurmaController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');