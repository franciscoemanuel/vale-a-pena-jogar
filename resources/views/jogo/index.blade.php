@extends('layout.principal')

@section('titulo', '| Jogos')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{asset('css/jogos.css')}}">
@stop

@section('conteudo')
<!--Todos os jogos-->
@include('partials._jogos')
@stop
