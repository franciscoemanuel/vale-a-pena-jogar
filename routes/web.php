<?php

Route::get('/', 'IndexController@index');

/*Rotas declaradas para o controller de usuários*/

Route::get('/cadastro', 'UsuarioController@create');

Route::post('/cadastro','UsuarioController@store');

Route::get('/login', 'UsuarioController@formLogin');

Route::post('/login', 'UsuarioController@login');

Route::post('/logout', 'UsuarioController@logout');

Route::post('/joguei', 'UsuarioController@joguei')->name('joguei');

/*Rotas declaradas para o controller de jogos*/

Route::get('/jogos/cadastro', 'JogoController@create');

Route::post('/jogos/cadastro', 'JogoController@store');

Route::get('/jogos', 'JogoController@index');

Route::get('/jogos/{nomeJogo}', 'JogoController@show');

/*Rotas declaradas para o controller de categorias*/

Route::get('/autocomplete/categorias', 'CategoriaController@buscaCategoriasJson');

Route::get('/categorias/cadastro', 'CategoriaController@create');

Route::post('/categorias/cadastro', 'CategoriaController@store');

/*Rotas declaradas para o controller de desenvolvedores*/

Route::get('/desenvolvedores/cadastro', 'DesenvolvedorController@create');

Route::post('/desenvolvedores/cadastro', 'DesenvolvedorController@store');

Route::get('/autocomplete/desenvolvedores', 'DesenvolvedorController@buscaDesenvolvedoresJson');

/*Rotas declaradas para o controller de distribuidoras*/

Route::get('/distribuidoras/cadastro', 'DistribuidoraController@create');

Route::post('/distribuidoras/cadastro', 'DistribuidoraController@store');

Route::get('/autocomplete/distribuidoras', 'DistribuidoraController@buscaDistribuidorasJson');
