<?php

Route::get('/', 'IndexController@index');

Route::get('/cadastro', 'UsuarioController@formCadastro');

Route::post('/cadastro','UsuarioController@cadastro');

Route::get('/login', 'UsuarioController@formLogin');

Route::post('/login', 'UsuarioController@login');

Route::post('/logout', 'UsuarioController@logout');

Route::get('/cadastro/desenvolvedores', 'DesenvolvedorController@formCadastro');

Route::post('/cadastro/desenvolvedores', 'DesenvolvedorController@cadastro');

Route::get('/cadastro/distribuidoras', 'DistribuidoraController@formCadastro');

Route::post('/cadastro/distribuidoras', 'DistribuidoraController@cadastro');

Route::get('/cadastro/categorias', 'CategoriaController@formCadastro');

Route::post('/cadastro/categorias', 'CategoriaController@cadastro');

Route::get('/autocomplete/desenvolvedores', 'DesenvolvedorController@buscaDesenvolvedoresJson');

Route::get('/autocomplete/distribuidoras', 'DistribuidoraController@buscaDistribuidorasJson');

Route::get('/autocomplete/categorias', 'CategoriaController@buscaCategoriasJson');


/*Rotas declaradas para o controller de jogos*/

Route::get('/jogos/cadastro', 'JogoController@create');

Route::post('/jogos/cadastro', 'JogoController@store');

Route::get('/jogos', 'JogoController@index');

Route::get('/jogos/{id}', 'JogoController@show');

Route::get('/distribuidora/{nomeDistribuidora}', function($nomeDistribuidora){
	$distribuidora = \vapj\Distribuidora::where('nomeDistribuidora', $nomeDistribuidora)->firstOrFail();
	dd($distribuidora->jogos);
});

Route::get('/desenvolvedor/{nomeDesenvolvedor}', function($nomeDesenvolvedor){
	$desenvolvedor = \vapj\desenvolvedor::where('nomeDesenvolvedor', $nomeDesenvolvedor)->firstOrFail();
	dd($desenvolvedor->jogos);
});