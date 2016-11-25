@extends('layout.principal')

@section('titulo', "| $jogo->nomeJogo")

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome-stars-o.css')}}">
<style type="text/css">
	.tituloJogo{
		width: 100%;
	}
	.titulo{
		font-size: 40px;x
	}
	.detalhes b{
		font-weight: strong;
	}
	.imagens{
		float: left;
		margin-right: 0.5em;
	}
	.containerBotao{
		float: right;
		line-height: 5;
	}
	.avaliacaoUsuario{
		font-weight: bold;
		font-size: 16px;
		font-family: arial;
	}
	.avaliacaoMedia{
		font-size: 20px;
		font-weight: bold;
	}
	.notaAvaliacao{
		text-align: center;
	}
	.avaliacaoMediaTitulo{
		float: left;
		border-right: 1px solid #f3f3f3;
		text-align: center;
		width: 50%;
	}
	.avaliacaoMediaTitulo h2{
		margin: 0
	}
	
	.info{
		background-color:#FAFAFA;
		float: left;
		max-width: 68rem;
	}
	.descricaoJogo{
		clear: both;
	}
	.section{
		font-size: 130%;
		border:1px solid #EFEFEF;		
		padding: 1%;
		border-radius:3px;
		border:1px solid #EFEFEF;
		width: 100%; 	
		line-height: 2.6;
		display: inline-block;
	}
</style>
@stop

@section('conteudo')
	<div id="jogo" data-idJogo="{{$jogo->idJogo}}" data-avaliacao="{{$avaliacaoMedia}}" data-avaliacaoUsuario="{{$avaliacaoUsuario}}">
		<div class="page-header">		
			<span class="titulo">{{$jogo->nomeJogo}}</span>
				<div class="containerBotao">
					<button id="botao-JaJoguei" class="btn {{ $usuarioPossuiJogo ? 'btn-success' : 'btn-default'}}" >
						Já joguei <i class="glyphicon glyphicon-ok"></i>
					</button>
				</div>
		</div>
			<div class="imagens">
				<img src={{asset('images/placeholder.png')}}>
			</div>
			<div class="info">
				<div class="section detalhes">
				<div>
					<b>Distribuido por:</b> {{$jogo->distribuidora->nomeDistribuidora}}
				</div>

				<div>
					<b>Desenvolvido por:</b> {{$jogo->desenvolvedor->nomeDesenvolvedor}}
				</div>

				<div>
					<b>Data de lançamento: </b> {{$jogo->dataLancamento->format('d/m/Y')}}
				</div>
			</div>
				<div class="section avaliacao">
					<span class="avaliacaoMediaTitulo">
					<h4>Avaliação média: </h4>
					<h2 class="bold">{{$avaliacaoMedia}} <small>/ 5</small></h2>
					</span>
					<span class="notaAvaliacao">
					<h4 class="bold">Sua avaliação: </h4> 
						<select id="estrelas">
						  <option></option>
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>
						  <option value="5">5</option>
						</select>
		            </span>
				</div>
				<div class="section categorias">
					@foreach($jogo->categorias as $categoria)
						<span class="label label-primary">{{$categoria->nomeCategoria}}</span>
					@endforeach
				</div>
		</div>
		<div class="descricaoJogo">
			{{$jogo->descricao}}
		</div>
	</div>
@stop

@section('scripts')
	<script src="{{asset('js/jquery.barrating.min.js')}}"></script>
	<script type="text/javascript">
	var idJogo = $('#jogo').data('idjogo');
	var url = "{{ route('jogou') }}";
	function isJogou(){
		var isJogou = $('.btn').attr('class') === "btn btn-success";
		return isJogou;
	}
	function avaliaJogo(avaliacao, jaAvaliou){
		$.ajax({
			method: 'POST',
			url: url,
			data: {idJogo: idJogo,jaAvaliou: jaAvaliou,avaliacao: avaliacao,_token: window.Laravel.csrfToken,},
			success: function(msg){
				console.log(msg['msg']);
			},
			error: function(msg){
				alert(msg);
				console.log("Erro ao realizar operação");
			},
			complete: function(){
				$("#estrelas").prop( "disabled", false );
			}
		});
	 	if (!isJogou())
		 	$('.btn').toggleClass('btn-success btn-default');
	}
	function jaJogou(){
		$.ajax({
			method: 'POST',
			url: url,
			data: {idJogo: idJogo,isJogou: isJogou(),_token: window.Laravel.csrfToken,},
			success: function(msg){
				console.log(msg['msg']);
			},
			error: function(msg){
				console.log("Erro ao realizar operação");
			},
			complete: function(){
				$('.btn').prop( "disabled", false );
			}
		});
	}
		$(function() {
			var avaliacaoUsuario = $('#jogo').data('avaliacaousuario');
			$('#estrelas').barrating({
		      theme: 'fontawesome-stars-o',
		      initialRating: avaliacaoUsuario,
		      allowEmpty: true,
		      deselectable: true,
		      onSelect: function(value, text) {
	            avaliaJogo(value, false);
	         }
		    });
		 });
		$(".btn").on('click', function(event){
			$(this).prop( "disabled", true );
			jaJogou();
			if (isJogou()){
				$("#estrelas").barrating('clear');
			}
			$(this).toggleClass('btn-success btn-default');
		});
	</script>
@stop