<?php

Route::get('/', 'IndexController@index');

Route::get('/cadastro', 'CadastroController@form');

Route::post('/cadastro','CadastroController@cadastro');


Route::get('/login', 'LoginController@form');

Route::post('/login', 'LoginController@login');

Route::post('/logout', 'LoginController@logout');

//Auth::routes();
