<?php

Route::get('/', function () {
    return view('layout.principal');
});

Route::get('/cadastro', 'UsuarioController@cadastro');

Route::post('/cadastrar','UsuarioController@cadastrar');
Auth::routes();

Route::get('/home', 'HomeController@index');
