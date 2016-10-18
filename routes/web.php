<?php

Route::get('/', 'IndexController@index');

Route::get('/cadastro', 'usuario\CadastroController@form');

Route::post('/cadastro','usuario\CadastroController@cadastro');


Route::get('/login', 'usuario\LoginController@form');

Route::post('/login', 'usuario\LoginController@login');

Route::post('/logout', 'usuario\LoginController@logout');

Route::get('/cadastro/jogos', 'jogo\CadastroController@form');

Route::post('/cadastro/jogos', 'jogo\CadastroController@cadastro');

Route::get('/cadastro/desenvolvedores', 'desenvolvedor\CadastroController@form');

Route::post('/cadastro/desenvolvedores', 'desenvolvedor\CadastroController@cadastro');

Route::get('/cadastro/distribuidoras', 'distribuidora\CadastroController@form');

Route::post('/cadastro/distribuidoras', 'distribuidora\CadastroController@cadastro');

Route::get('/cadastro/categorias', 'categoria\CadastroController@form');

Route::post('/cadastro/categorias', 'categoria\CadastroController@cadastro');

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