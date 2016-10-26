@extends('layout.principal')

@section('titulo', '| Jogos')

@section('styles')
	<style type="text/css">
	.jogoContainer {
		display: inline-block;
	    position: relative;
	    width: 180px;
	    height: 150px;
	    margin: 0 9px;
	}
	.titulo{
		margin-top: 8px;
		word-wrap: break-word;
		font-weight: bold;
		font-size: inherit;
	}
	.listaJogos{
		display: inline-block;
		float: none;
		list-style: none;
		vertical-align: top;
		margin-bottom: 20px;
		margin-left: 14px;
	}
	.listaJogos{
		text-align: center;
		display: inline-block;
		font-size: 11.9px;
		line-height: 14.28px;
	}
	</style>
@stop

@section('conteudo')
	<ul>
	@foreach($jogos as $jogo)
		<li class="listaJogos">
			<span class="jogoContainer">
				<a href="{{url('/jogos/'.$jogo->nomeJogo)}}">
					<img class="img-thumbnail" src={{asset('images/placeholder.png')}}>
					<h3 class="titulo">{{$jogo->nomeJogo}}</h3>
				</a>
			</span>
		</li>
	@endforeach
	</ul>
	{{ $jogos->links() }}
@stop
