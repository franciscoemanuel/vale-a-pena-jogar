@extends('layout.principal')

@section('titulo', " | listas")

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/_listas.css')}}">
@stop

@section('conteudo')

<a data-toggle="modal" href="{{Auth::guest() ? '#loginModal' : route('novaLista')}}">
	<button  class="btn btn-primary">Nova Lista</button>
</a>
	
@include('partials._listas')
@stop

@section('scripts')
@stop
