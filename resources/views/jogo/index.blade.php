@extends('layout.principal')

@section('titulo', '| Jogos')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.min.css')}}">	
<link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('css/jogos.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/pesquisa.css')}}">
@stop

@section('conteudo')
<!--Todos os jogos-->
<a class="pull-right" data-toggle="modal" href="{{Auth::guest() ? '#loginModal' : route('jogo.sugestao')}}">
	<button  class="btn btn-default">Sugerir novo jogo <i class="fa fa-plus-circle"></i></button>
</a>
<div class="row pesquisa">
	<form class="form-horizontal" role="form">
		<div class="col-md-12">
		    <div class="input-group" id="adv-search">
		        <input name="busca" type="text" class="form-control" placeholder="Procurar jogos..." value="{{ request('busca') }}"/>
		        <div class="input-group-btn">
		            <div class="btn-group" role="group">
		                <div class="dropdown dropdown-lg">
		                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
		                    <div class="dropdown-menu dropdown-menu-right" role="menu">
		                          <div class="form-group">
		                            <label for="filter">Ordernar por: </label>
		                            <select name="ordem" class="form-control">
		                                <option value="notaMedia" {{request('ordem') == 'notaMedia' ? 'selected' : ''}}>Nota média</option>
		                                <option value="dataLancamento" {{request('ordem') == 'dataLancamento' ? 'selected' : ''}}>Data de lançamento</option>
		                                <option value="nomeJogo" {{request('ordem') == 'nomeJogo' ? 'selected' : ''}}>Ordem alfabética</option>
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
@include('partials._jogos')
@stop

@section('scripts')
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/pt-BR.js')}}"></script>
<script src="{{asset('js/cadastroJogos.js')}}"></script>
<script src="{{asset('js/pesquisa.js')}}"></script>
@stop
