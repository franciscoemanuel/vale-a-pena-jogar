@extends('layout.principal')

@section('titulo', "| $jogo->nomeJogo")

@section('styles')
<style type="text/css">
	.tituloJogo{
		width: 100%;
	}
	.titulo{
		font-size: 40px;x
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
	.containerBotao{
		float: right;
		line-height: 5;
	}
</style>
@stop

@section('conteudo')
	<div id="jogo" data-idJogo="{{$jogo->idJogo}}">
		<div class="tituloJogo">		
			<span class="titulo">{{$jogo->nomeJogo}}</span>
			@if (!Auth::guest())
				<div class="containerBotao">
					<button id="botao-JaJoguei" class="btn {{ Auth::user()->possuiJogo($jogo->idJogo) ? 'btn-success' : 'btn-default'}}" >
						Já joguei <i class="glyphicon glyphicon-ok"></i>
					</button>
				</div>
			@endif
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
	</div>
@stop

@section('scripts')
	<script type="text/javascript">
			$(".btn").on('click', function(event){
				var url = "{{ route('joguei') }}";
				var idJogo = document.getElementById('jogo').dataset.idjogo;
				var jaJogou = event.target.className === "btn btn-success";
				$(this).prop( "disabled", true );
				$.ajax({
					method: 'POST',
					url: url,
					data: {idJogo: idJogo,jaJogou: jaJogou,_token: window.Laravel.csrfToken,},
					success: function(msg){
						console.log(msg['msg']);
					},
					error: function(msg){
						console.log("Erro ao realizar operação");
					},
					complete: function(){
						$(event.target).prop( "disabled", false );
					}
				});
				$(this).toggleClass('btn-success btn-default');
			});
	</script>
@stop