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
Route::get("/listas", "ListaController@index");

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

Route::get('/admin/login', 'Auth\AdminLoginController@getLoginForm')->name('admin.login');

Route::post('/admin/login', 'Auth\AdminLoginController@postLoginForm')->name('admin.login.submit');

Route::get('/admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

Route::get('/admin', 'AdminController@index')->name('admin.dashboard');	

Route::get('/admin/jogos', 'JogoController@adminIndex')->name('admin.jogos')->middleware('auth:admin');

Route::get('/admin/jogos/cadastro', 'JogoController@create')->name('jogo.cadastro')->middleware('auth:admin');

Route::post('/admin/jogos/cadastro', 'JogoController@store')->name('jogo.cadastro.submit')->middleware('auth:admin');

Route::get('/admin/jogos/editar/{nomeJogo}', 'JogoController@edit')->name('jogo.editar')->middleware('auth:admin');

Route::post('/admin/jogos/editar/{nomeJogo}', 'JogoController@update')->name('jogo.editar.submit')->middleware('auth:admin');

Route::delete('/admin/jogos/excluir/{id}', 'JogoController@destroy')->name('jogo.excluir')->middleware('auth:admin');
//Desenvolvedores
Route::get('/admin/desenvolvedores', 'DesenvolvedorController@adminIndex')->name('admin.desenvolvedores')->middleware('auth:admin');

Route::get('/admin/desenvolvedores/cadastro', 'DesenvolvedorController@create')->name('desenvolvedor.cadastro')->middleware('auth:admin');

Route::post('/admin/desenvolvedores/cadastro', 'DesenvolvedorController@store')->name('desenvolvedor.cadastro.submit')->middleware('auth:admin');

Route::get('/admin/desenvolvedores/editar/{id}', 'DesenvolvedorController@edit')->name('desenvolvedor.editar')->middleware('auth:admin');

Route::post('/admin/desenvolvedores/editar/{id}', 'DesenvolvedorController@update')->name('desenvolvedor.editar.submit')->middleware('auth:admin');

Route::delete('/admin/desenvolvedores/excluir/{id}', 'DesenvolvedorController@destroy')->name('desenvolvedor.excluir')->middleware('auth:admin');

//Distribuidoras
Route::get('/admin/distribuidoras', 'DistribuidoraController@adminIndex')->name('admin.distribuidoras')->middleware('auth:admin');

Route::get('/admin/distribuidoras/cadastro', 'DistribuidoraController@create')->name('distribuidora.cadastro')->middleware('auth:admin');

Route::post('/admin/distribuidoras/cadastro', 'DistribuidoraController@store')->name('distribuidora.cadastro.submit')->middleware('auth:admin');

Route::get('/admin/distribuidoras/editar/{id}', 'DistribuidoraController@edit')->name('distribuidora.editar')->middleware('auth:admin');

Route::post('/admin/distribuidoras/editar/{id}', 'DistribuidoraController@update')->name('distribuidora.editar.submit')->middleware('auth:admin');

Route::delete('/admin/distribuidoras/excluir/{id}', 'DistribuidoraController@destroy')->name('distribuidora.excluir')->middleware('auth:admin');
//Categorias
Route::get('/admin/categorias', 'CategoriaController@adminIndex')->name('admin.categorias')->middleware('auth:admin');

Route::get('/admin/categorias/cadastro', 'CategoriaController@create')->name('categoria.cadastro')->middleware('auth:admin');

Route::post('/admin/categorias/cadastro', 'CategoriaController@store')->name('categoria.cadastro.submit')->middleware('auth:admin');

Route::get('/admin/categorias/editar/{id}', 'CategoriaController@edit')->name('categoria.editar')->middleware('auth:admin');

Route::post('/admin/categorias/editar/{id}', 'CategoriaController@update')->name('categoria.editar.submit')->middleware('auth:admin');

Route::delete('/admin/categorias/excluir/{id}', 'CategoriaController@destroy')->name('categoria.excluir')->middleware('auth:admin');
//Listas
Route::get('/admin/listas', 'ListaController@adminIndex')->name('admin.listas')->middleware('auth:admin');

Route::delete('/admin/listas/excluir/{id}', 'ListaController@destroy')->name('admin.lista.excluir')->middleware('auth:admin');

//Usuarios
Route::get('/admin/usuarios', 'UsuarioController@adminIndex')->name('admin.usuarios')->middleware('auth:admin');

Route::delete('/admin/usuarios/excluir/{id}', 'UsuarioController@destroy')->name('usuario.excluir')->middleware('auth:admin');