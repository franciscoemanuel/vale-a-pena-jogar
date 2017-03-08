@extends('layout.principal')

@section('titulo', " | listas")

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/_listas.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pesquisa.css')}}">
@stop

@section('conteudo')

<a class="pull-right" data-toggle="modal" href="{{Auth::guest() ? '#loginModal' : route('novaLista')}}">
	<button  class="btn btn-default">Criar nova lista <i class="fa fa-plus-circle"></i></button>
</a>
<div class="row pesquisa">
	<form class="form-horizontal" role="form">
		<div class="col-md-12">
		    <div class="input-group" id="adv-search">
		        <input name="busca" type="text" class="form-control" autofocus placeholder="Procurar listas..." value="{{ request('busca') }}"/>
		        <div class="input-group-btn">
		            <div class="btn-group" role="group">
		                <div class="dropdown dropdown-lg">
		                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
		                    <div class="dropdown-menu dropdown-menu-right" role="menu">
		                          <div class="form-group">
		                            <label for="filter">Ordernar por: </label>
		                            <select name="ordem" class="form-control">
		                                <option value="qtdCurtidas" {{request('ordem') == 'qtdCurtidas' ? 'selected' : ''}}>Mais curtidas</option>
		                                <option value="qtdComentarios" {{request('ordem') == 'qtdComentarios' ? 'selected' : ''}}>Mais comentadas</option>
		                                <option value="nomeLista" {{request('ordem') == 'nomeLista' ? 'selected' : ''}}>Ordem alfabética</option>
		                            </select>
		                          </div>
		                    </div>
		                </div>
		                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
		            </div>
		        </div>
		    </div>
	  	</div>
	</form>
</div>	

@include('partials._listas')
@stop

@section('scripts')
<script src="{{asset('js/pesquisa.js')}}"></script>
@stop
