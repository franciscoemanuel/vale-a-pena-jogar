<?php

Route::get('/', 'IndexController@index')->name('index');


/*Rotas declaradas para o controller de usuários*/

Route::get('/cadastro', 'UsuarioController@create');

Route::post('/cadastro','UsuarioController@store');

Route::get('/login', 'UsuarioController@formLogin');

Route::post('/login', 'UsuarioController@login');

Route::post('/logout', 'UsuarioController@logout');

Route::post('/jogou', 'UsuarioController@jogou')->name('jogou');

Route::get('/usuarios/{usuario}', 'UsuarioController@show')->name('usuario');

Route::get('/usuarios/{usuario}/jogos', 'UsuarioController@jogos')->name('jogos_usuario');

/*Rotas declaradas para o controller de jogos*/

Route::get('/jogos/cadastro', 'JogoController@create');

Route::post('/jogos/cadastro', 'JogoController@store');

Route::get('/jogos', 'JogoController@index')->name('jogos.index');

Route::get('/jogos/{nomeJogo}', 'JogoController@show')->name('jogos.single');

Route::get('/jogos/editar/{nomeJogo}', 'JogoController@edit')->name('editarJogo');

Route::post('/jogos/editar/{nomeJogo}', 'JogoController@update');

Route::get("/autocomplete/jogos", "JogoController@buscaJogosJson");

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

//Rotas declaradas para o controller de críticas
Route::post('/critica', [
	'uses' => 'CriticaController@store',
    'as'  => 'critica'	
]);

Route::get('/critica', [
	'uses' => 'CriticaController@criticas'
]);

Route::put('/critica/{id}', [
	'uses' => 'CriticaController@update'
]);

Route::delete('/critica/{id}', [
	'uses' => 'CriticaController@destroy'
]);


//Rotas para listas
Route::get("/listas", "ListaController@index");

Route::get("/listas/nova-lista", "ListaController@create")->name("novaLista");

Route::post("/listas/nova-lista", "ListaController@store");

Route::get("/listas/{id}", "ListaController@show");

Route::get("/listas/editar/{id}", "ListaController@edit")->name("editarLista");

Route::post("/listas/editar/{id}", "ListaController@update");

Route::delete('/listas/excluir/{id}', "ListaController@destroy")->name("excluirLista");

Route::post("/curtirLista", "ListaController@curtirLista")->name("curtirLista");

Route::post('/comentarLista', "ListaController@comentarLista")->name("comentarLista");

//Rotas para comentários

Route::delete("/comentarios/{id}", "ComentarioController@destroy")->name("excluirComentario");

