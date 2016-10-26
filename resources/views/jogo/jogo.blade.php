@extends('layout.principal')

@section('titulo', "| $jogo->nomeJogo")

@section('styles')
<style type="text/css">
	.tituloJogo{
		width: 100%;
	}
	.detalhes{
		width: 35%;
		padding: 10px 0px 20px 0px;
		clear: both;
	}
	.detalhes b{
		font-weight: strong;
	}
	.imagens{
		width: 35%;
		float: left;
	}
	.descricaoJogo{
		
	}
</style>
@stop

@section('conteudo')
	<div class="tituloJogo">
		<h1>{{$jogo->nomeJogo}}</h1>
	</div>
	<div >
		<div class="imagens">
			<img src={{asset('images/placeholder.png')}}>
		</div>

		<div class="detalhes">
			<b>Categorias :</b>
			@foreach($jogo->categorias as $categoria)
				<span class="label label-primary">{{$categoria->nomeCategoria}}</span>
			@endforeach

		<div>
			<b>Distribuidora:</b> {{$jogo->distribuidora->nomeDistribuidora}}
		</div>

		<div>
			<b>Desenvolvedor:</b> {{$jogo->desenvolvedor->nomeDesenvolvedor}}
		</div>

		<div>
			<b>Data de lançamento: </b> {{$jogo->dataLancamento->format('d/m/Y')}}
		</div>
	</div>
	<div class="descricaoJogo">
		{{$jogo->descricao}}
	</div>
@stop
