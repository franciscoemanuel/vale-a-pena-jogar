@extends('layout.principal')

@section('titulo', " | $usuario->nomeUsuario")

@section('styles')
<!--Folhas de estilo-->
<link rel="stylesheet" type="text/css" href="{{asset('css/jogos.css')}}">
@stop

@section('conteudo')
<!--Conteúdo-->
<div class="row">
	<div class="col-md-2">
		<img class="img-thumbnail" src="https://kenanfellows.org/wp-content/uploads/2016/02/blank-profile-picture-973460_960_720.png">
	</div>
	<div class="col-md-6">
		<h3>{{$usuario->nomeCompletoUsuario}}</h3>
		<p><strong>Data de nascimento: </strong>{{$usuario->DataNascimentoUsuario}}</p>
		<p><strong>E-mail: </strong>{{$usuario->emailUsuario}}</p>
		<p><strong>Sexo: </strong>{{$usuario->sexo = "M" ? "Masculino" : "Feminino"}}</p>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs nav-justified">
		  <li class="active">
		  	<a id="btn-jogos" href="#"><i class="fa fa-gamepad"></i> <strong class="hidden-xs">Jogos</strong> <span class="badge">42</span></a>
		  </li>
		  <li>
		  	<a  id="btn-listas" href="#"><i class="glyphicon glyphicon-th-list"></i> <strong class="hidden-xs">Listas</strong> <span class="badge">10</span></a>
		  </li>
		  <li>
		  	<a  id="btn-criticas" href="#"><i class="fa fa-star-half-o"></i> <strong class="hidden-xs">Críticas</strong> <span class="badge">0</span></a>
		  </li>
		</ul>
	</div>
</div>

<div class="row" style="margin-top: 2em;">
	<div class="col-md-12">
		<div class="jogos">
			@foreach($usuario->jogos as $jogo)
				<li class="listaJogos">
					<span class="jogoContainer">
						<a href="{{url('/jogos/'.$jogo->nomeJogo)}}">
							<img class="img-thumbnail" src={{asset('images/placeholder.png')}}>
							<h3 class="titulo">{{$jogo->nomeJogo}}</h3>
						</a>
					</span>
				</li>
			@endforeach
		</div>
		<div class="listas" hidden>
			<h3>Listas</h3>
		</div>
		<div class="criticas" hidden>
			@foreach ($criticas as $critica)
				<div class="row criticasJogo" id="criticas">
					<div class="col-md-1 col-xs-2">
						<div class="thumbnail">
							<img class="img-responsive user-photo" src="{{asset('images/avatar.png')}}">
						</div><!-- /thumbnail -->
					</div>
					<div class="col-md-5 col-xs-9">
						<div class="panel panel-default comentarios">
							<div class="panel-heading">
								<strong>{{$critica->usuario->nomeUsuario}}</strong>
								<span>{{$critica->dataCriacao}}</span>
								<span class="notaCritica">
									<i class="fa fa-star"></i> 
									{{$critica->nota ? $critica->nota : 0}}/
									<small>5</small> 
								</span>
							</div>
							<div class="panel-body">
								<span class="comentario">{{$critica->comentario}}</span>
							</div>
							<!-- 
							<div class="panel-footer">
									<a id="link-editar" href="#" data-toggle="modal" data-target="#criticaModal"><i class="fa fa-pencil"></i> Editar</a>
									<a href="#" data-idCritica="{{$critica->idCritica}}" data-toggle="confirmation"><i class="fa fa-trash-o"></i> Excluir</a>
							</div>
	 						 -->
						</div>
					</div>
				</div>
				@endforeach
				{{$criticas->links()}}
		</div>
	</div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
$(function(){
	$("#btn-listas").on('click', function(event) {
		event.preventDefault();
		$(".listas").show();
		$(".jogos").hide();
		$(".criticas").hide();
	});
});
</script>
@stop