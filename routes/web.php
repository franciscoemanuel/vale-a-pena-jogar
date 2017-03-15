<?php

Route::get('/', 'IndexController@index')->name('index');


/*Rotas declaradas para o controller de usuários*/

Route::get('/cadastro', 'UsuarioController@create');

Route::post('/cadastro','UsuarioController@store');

Route::get('/login', 'UsuarioController@formLogin')->name('login');

Route::post('/login', 'UsuarioController@login');

Route::post('/logout', 'UsuarioController@logout');

Route::post('/jogou', 'UsuarioController@jogou')->name('jogou');

Route::get('/usuarios/{usuario}', 'UsuarioController@show')->name('usuario');

Route::get('/usuarios/{usuario}/jogos', 'UsuarioController@jogos')->name('jogos_usuario');

Route::get('/usuarios', 'UsuarioController@index')->name('usuarios');

Route::get('/meus-dados', 'UsuarioController@dadosUsuario')->name('usuario.dados')->middleware('auth');

Route::post('/meus-dados', 'UsuarioController@postDadosUsuario')->name('usuario.dados.submit')->middleware('auth');

/*Rotas declaradas para o controller de jogos*/

Route::get('/jogos', 'JogoController@index')->name('jogos.index');

Route::get('/jogos/{nomeJogo}', 'JogoController@show')->name('jogos.single');

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
Route::get("/listas", "ListaController@index")->name('listas.index');

Route::get("/listas/nova-lista", "ListaController@create")->name("novaLista")->middleware('auth');

Route::post("/listas/nova-lista", "ListaController@store");

Route::get("/listas/{id}", "ListaController@show");

Route::get("/listas/editar/{id}", "ListaController@edit")->name("editarLista");

Route::post("/listas/editar/{id}", "ListaController@update");

Route::delete('/listas/excluir/{id}', "ListaController@destroy")->name("excluirLista");

Route::post("/curtirLista", "ListaController@curtirLista")->name("curtirLista");

Route::post('/comentarLista', "ListaController@comentarLista")->name("comentarLista");

//Rotas para comentários

Route::delete("/comentarios/{id}", "ComentarioController@destroy")->name("excluirComentario");

//Rotas para admin

Route::group(['prefix' => 'admin', 'namespace' => 'Auth'], function(){

	Route::get('login', 'AdminLoginController@getLoginForm')->name('admin.login');

	Route::post('login', 'AdminLoginController@postLoginForm')->name('admin.login.submit');

	Route::get('logout', 'AdminLoginController@logout')->name('admin.logout');

});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function(){
	
	Route::get('/', 'AdminController@index')->name('admin.dashboard');	

	//Jogos
	Route::get('jogos', 'JogoController@adminIndex')->name('admin.jogos');

	Route::get('jogos/cadastro', 'JogoController@create')->name('jogo.cadastro');

	Route::post('jogos/cadastro', 'JogoController@store')->name('jogo.cadastro.submit');

	Route::get('jogos/editar/{nomeJogo}', 'JogoController@edit')->name('jogo.editar');

	Route::post('jogos/editar/{nomeJogo}', 'JogoController@update')->name('jogo.editar.submit');

	Route::delete('jogos/excluir/{id}', 'JogoController@destroy')->name('jogo.excluir');
	//Desenvolvedores
	Route::get('desenvolvedores', 'DesenvolvedorController@adminIndex')->name('admin.desenvolvedores');

	Route::get('desenvolvedores/cadastro', 'DesenvolvedorController@create')->name('desenvolvedor.cadastro');

	Route::post('desenvolvedores/cadastro', 'DesenvolvedorController@store')->name('desenvolvedor.cadastro.submit');

	Route::get('desenvolvedores/editar/{id}', 'DesenvolvedorController@edit')->name('desenvolvedor.editar');

	Route::post('desenvolvedores/editar/{id}', 'DesenvolvedorController@update')->name('desenvolvedor.editar.submit');

	Route::delete('desenvolvedores/excluir/{id}', 'DesenvolvedorController@destroy')->name('desenvolvedor.excluir');

	//Distribuidoras
	Route::get('distribuidoras', 'DistribuidoraController@adminIndex')->name('admin.distribuidoras');

	Route::get('distribuidoras/cadastro', 'DistribuidoraController@create')->name('distribuidora.cadastro');

	Route::post('distribuidoras/cadastro', 'DistribuidoraController@store')->name('distribuidora.cadastro.submit');

	Route::get('distribuidoras/editar/{id}', 'DistribuidoraController@edit')->name('distribuidora.editar');

	Route::post('distribuidoras/editar/{id}', 'DistribuidoraController@update')->name('distribuidora.editar.submit');

	Route::delete('distribuidoras/excluir/{id}', 'DistribuidoraController@destroy')->name('distribuidora.excluir');

	//Categorias
	Route::get('categorias', 'CategoriaController@adminIndex')->name('admin.categorias');

	Route::get('categorias/cadastro', 'CategoriaController@create')->name('categoria.cadastro');

	Route::post('categorias/cadastro', 'CategoriaController@store')->name('categoria.cadastro.submit');

	Route::get('categorias/editar/{id}', 'CategoriaController@edit')->name('categoria.editar');

	Route::post('categorias/editar/{id}', 'CategoriaController@update')->name('categoria.editar.submit');

	Route::delete('categorias/excluir/{id}', 'CategoriaController@destroy')->name('categoria.excluir');

	//Usuarios
	Route::get('usuarios', 'UsuarioController@adminIndex')->name('admin.usuarios');

	Route::get('usuarios/editar/{usuario}', 'UsuarioController@edit')->name('usuario.editar');

	Route::post('usuarios/editar/{usuario}', 'UsuarioController@update')->name('usuario.editar.submit');

	Route::delete('usuarios/excluir/{id}', 'UsuarioController@destroy')->name('usuario.excluir');
});