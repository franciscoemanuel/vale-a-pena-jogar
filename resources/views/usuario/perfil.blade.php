@extends('layout.principal')

@section('titulo', " | $usuario->nomeUsuario")

@section('styles')
<!--Folhas de estilo-->
<link rel="stylesheet" type="text/css" href="{{asset('css/jogos.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/_criticas.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/_listas.css')}}">
@stop

@section('conteudo')
<!--Conteúdo-->
<div class="row">
	<div class="col-md-2">
		<img class="img-thumbnail" src="{{asset('images/avatar.png')}}">
	</div>
	<div class="col-md-6">
		<h3>{{$usuario->nomeCompletoUsuario}}</h3>
		<p><strong>Data de nascimento: </strong>{{$usuario->dataNascimentoUsuario}}</p>
		<p><strong>E-mail: </strong>{{$usuario->emailUsuario}}</p>
		<p><strong>Sexo: </strong>{{$usuario->sexo == "M" ? "Masculino" : "Feminino"}}</p>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs nav-justified">
		  <li class="active">
		  	  <a class="btn-abas" href="#"><i class="fa fa-gamepad"></i> <strong>Jogos</strong> <span class="badge">{{$usuario->jogos->count()}}</span></a>
		  </li>
		  <li>
		  	  <a class="btn-abas" href="#"><i class="fa fa-star-half-o"></i> <strong>Críticas</strong> <span class="badge">{{$usuario->criticas->count()}}</span></a>
		  </li>
		  <li>
		  	  <a class="btn-abas"  href="#"><i class="glyphicon glyphicon-th-list"></i> <strong>Listas</strong> <span class="badge">{{$usuario->listas->count()}}</span></a>
		  </li>
		</ul>
	</div>
</div>

<div class="row" style="margin-top: 2em;">
	<div class="col-md-12">
		<div class="jogos abas">
			<!--Todos os jogos do usuário-->
			@include('partials._jogos')
		</div>
		<div class="criticas abas" hidden>
			<!--Criticas do usuário-->
			@include('partials._criticas')
		</div>
		<div class="listas abas" hidden>
			@if (\Auth::check() && Auth::user()->idUsuario == $usuario->idUsuario)
			<a href={{route('novaLista')}}>
				<button class="btn btn-primary">Nova Lista</button>
			</a>
			@endif
			@include('partials._listas')
		</div>
	</div>
</div>

@stop

@section('scripts')
<script src="{{asset('js/bootstrap-confirmation.min.js')}}"></script>
<script src="{{asset('js/_criticas.js')}}"></script>
<script type="text/javascript">
$(function(){
	$(".btn-abas").on('click', function(event) {
		var li = $(this).parents('li');
		li.addClass('active').siblings().removeClass('active');
		$(".abas").eq(li.index()).show()
		.siblings().hide();
	});
});
</script>
@stop