<?php

Route::get('/', 'IndexController@index');

Route::get('/cadastro', 'UsuarioController@formCadastro');

Route::post('/cadastro','UsuarioController@cadastro');


Route::get('/login', 'UsuarioController@formLogin');

Route::post('/login', 'UsuarioController@login');

Route::post('/logout', 'UsuarioController@logout');

Route::get('/cadastro/jogos', 'JogoController@formCadastro');

Route::post('/cadastro/jogos', 'JogoController@cadastro');

Route::get('/cadastro/desenvolvedores', 'DesenvolvedorController@formCadastro');

Route::post('/cadastro/desenvolvedores', 'DesenvolvedorController@cadastro');

Route::get('/cadastro/distribuidoras', 'DistribuidoraController@formCadastro');

Route::post('/cadastro/distribuidoras', 'DistribuidoraController@cadastro');

Route::get('/cadastro/categorias', 'CategoriaController@formCadastro');

Route::post('/cadastro/categorias', 'CategoriaController@cadastro');

Route::get('/distribuidora/{nomeDistribuidora}', function($nomeDistribuidora){
	$distribuidora = \vapj\Distribuidora::where('nomeDistribuidora', $nomeDistribuidora)->firstOrFail();
	dd($distribuidora->jogos);
});

Route::get('/desenvolvedor/{nomeDesenvolvedor}', function($nomeDesenvolvedor){
	$desenvolvedor = \vapj\desenvolvedor::where('nomeDesenvolvedor', $nomeDesenvolvedor)->firstOrFail();
	dd($desenvolvedor->jogos);
});


Route::get('/jogos/{nomeJogo}', function($nomeJogo){
	$jogo = \vapj\Jogo::where('nomeJogo', $nomeJogo)->firstOrFail();
	echo "Nome do jogo: ".$jogo->nomeJogo;
	echo "<br>Categorias: ";
	foreach ($jogo->categorias as $categoria) {
		echo $categoria->nomeCategoria;
	}
});