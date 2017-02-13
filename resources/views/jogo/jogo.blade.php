@extends('layout.principal')

@section('titulo', "| $jogo->nomeJogo")

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome-stars-o.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/jogo.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/_criticas.css')}}">
@stop

@section('conteudo')
 	<div class="container jogo">
 		<div class="page-header">
 			<div class="row">
 				<div class="col-md-8">
	 				<span class="titulo">{{$jogo->nomeJogo}}</span>
	 			</div>
	 			<div class="col-md-2 col-md-offset-2">
		 			<button id="btn-joguei" class="btn {{ $usuarioPossuiJogo ? 'btn-success' : 'btn-default'}}" >
		 				Já joguei <i class="glyphicon glyphicon-ok"></i>
		 			</button>
	 			</div>
 			</div>
 		</div>
 		<div class="well">
 			<div class="container-fluid">
 				<div class="row">
 					<div class="fotosJogo col-md-5">
 						<img src={{asset('images/placeholder.png')}}>
 					</div>
 					<div class="col-md-7 detalhes">
	 					<div class="col-md-7">
	 							<h4>Desenvolvedor: <small>{{$jogo->desenvolvedor->nomeDesenvolvedor}}</small></h4>
	 							<h4>Distribuidora:  <small>{{$jogo->distribuidora->nomeDistribuidora}}</small></h4>
	 							<h4>Data de lançamento: <small>{{$jogo->dataLancamento->format('d/m/Y')}}</small></h4>
	 					</div>
	 					<div class="avaliacaoMedia col-md-4 col-md-offset-1">
	 						<div class="notaMedia"><i class="fa fa-star"></i>  {{$jogo->notaMedia}} <small>/ 5</small></div>
	 						<small class="numCriticas">(baseado em {{$jogo->numCriticas}} {{str_plural('critica',$jogo->numCriticas)}})</small>	
	 					</div>
	 					<div class="col-md-12 categorias">
	 						<span class="label label-primary">{{$jogo->quantidadeJogadores}}</span>
	 						@foreach($jogo->categorias as $categoria)
	 							<span class="label label-primary">{{$categoria->nomeCategoria}}</span>
	 						@endforeach
	 					</div>
 					</div>
 				</div>
 				<div class="row">
 					<div class="col-md-12 sobre">
 						<strong>Sobre o jogo: </strong>
 						<p>{{$jogo->descricao}}</p>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
	<div class="modal fade" id="criticaModal" tabindex="-1" role="dialog" hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	        	<div class="modal-header well">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
	        		<strong>Crítica</strong>
	        	</div>
	        	<div class="modal-body">
					<form id="criticaForm">
						<div class="form-group" id="div-comentario">
							<textarea maxlength="200" class="form-control" name="comentario" id="txt-comentario" rows="3" required placeholder="Vale a pena jogar?">{{$criticaUsuario ? $criticaUsuario->comentario : ''}}</textarea>
							<span class="help-block">
							    <strong id="erro-comentario"></strong>
							</span>
						</div>
						<div class="form-group" id="div-nota">
							<select name="nota" id="select-nota">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
							<span class="help-block">
							    <strong id="erro-nota"></strong>
							</span>
						</div>
						<input type="hidden" name="_token" value="{{csrf_token()}}" />
						<input type="hidden" name="idJogo" value="{{$jogo->idJogo}}" />
						<div class="text-right">
							<button type="submit" class="btn btn-primary" id="btn-critica" ><i class="fa fa-share-square-o"></i> Enviar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid comentario-usuario">
		<div class="row">
			<div class="col-md-8">
				<div class="col-md-6">
					<h3>Críticas</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				@if (!$criticaUsuario)
				<div class="well">
					<strong>Você não avaliou este jogo..</strong>
					<button class="btn btn-default" data-toggle="modal" data-target={{Auth::guest() ? "#loginModal" : "#criticaModal"}}>
						Avaliar <i class="glyphicon glyphicon-star"></i>
					</button>
				</div>
				@endif
			</div>
		</div>	
		<!--Criticas-->
		@include('partials._criticas')
	</div>  
@stop

@section('scripts')
	<script src="{{asset('js/jquery.barrating.min.js')}}"></script>
	<script src="{{asset('js/jogo.js')}}"></script>
	<script src="{{asset('js/bootstrap-confirmation.min.js')}}"></script>
@stop