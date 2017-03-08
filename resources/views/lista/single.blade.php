@extends('layout.principal')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/jogos.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/_criticas.css')}}">
<style type="text/css">	
.comentarios .thumbnail{
	padding: 0px;
}
</style>
@stop

@section('conteudo')
<div class="page-header">
	@if ($lista->usuario == \Auth::User())
	<div class="row">
		<div class="col-md-6">
		<a href={{route('editarLista', $lista->idLista)}}><button id="btn-editar" class="btn btn-primary"><i class="fa fa-pencil"></i> Editar</button></a>
		<a href="#" data-idLista="{{$lista->idLista}}" data-toggle="confirmation"><button id="btn-excluirLista" class="btn btn-danger"><i class="fa fa-trash-o"></i> Excluir</button></a>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-md-12">
			<h2>{{$lista->nomeLista}}</h2>
			<p>{{$lista->descricaoLista}}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-offset-8 col-md-offset-10">
			<small>Lista criada por: <a href="/usuarios/{{$lista->usuario->nomeUsuario}}"> <strong>{{$lista->usuario->nomeUsuario}}</strong> </a></small>
		</div>
		<div class="col-xs-2">
			@if ($usuarioCurtiuLista)
			<a data-idLista="{{$lista->idLista}}" href="#" id="btn-curtir" class="btn btn-success">
				<span class="texto">Curtiu </span> <span class="fa fa-thumbs-o-up"></span> (<span id="qtdCurtidas">{{$lista->qtdCurtidas}}</span>)
			</a>
			@else
			<a data-idLista="{{$lista->idLista}}" href="#" id="btn-curtir" class="btn btn-default">
				<span class="texto">Curtir </span> <span class="fa fa-thumbs-o-up"></span>  (<span id="qtdCurtidas">{{$lista->qtdCurtidas}}</span>)
			</a>
			@endif
		</div>
	</div>
</div>
@include('partials._jogos')

<div class="modal fade" id="comentarioModal" tabindex="-1" role="dialog" hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-header well">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        		<strong>Comentário</strong>
        	</div>
        	<div class="modal-body">
				<form id="comentarioForm">
					<div class="form-group" id="div-comentario">
						<textarea maxlength="600" class="form-control" name="comentario" id="txt-comentario" rows="5" required placeholder="O que você achou da lista?">{{$comentarioUsuario ? $comentarioUsuario->comentario : ''}}</textarea>
						<span class="help-block">
						    <strong id="erro-comentario"></strong>
						</span>
					</div>
					<input type="hidden" name="idLista" value="{{$lista->idLista}}" />
					<input type="hidden" name="_token" value="{{csrf_token()}}" />
					<small class="text-left"> <span id="caracteres">600</span> caracteres restantes</small>
					<div class="text-right">
						<button type="submit" class="btn btn-primary" id="btn-comentario" ><i class="fa fa-share-square-o"></i> Enviar</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="container-fuild comentarios" id="#comentarios">
	<div class="row">
		<div class="col-xs-12">
			<h3>Comentários <span class="badge">{{$lista->qtdComentarios}}</span></h3>
		</div>
		<div class="col-xs-2">
			@if (!$comentarioUsuario)
			<a href="#" data-toggle="modal" data-target={{Auth::guest() ? "#loginModal" : "#comentarioModal"}} class="btn btn-default">Deixar um comentário <span class="fa fa-commenting-o"></span></a>
			@endif
		</div>
	</div>
	<br>
	@foreach($lista->comentarios as $comentario)
	<div class="row">
		<div class="col-md-1 col-xs-2">
			<div class="thumbnail">
				<img class="img-responsive user-photo" src="{{asset('images/avatar.png')}}">
			</div><!-- /thumbnail -->
		</div>
		<div class="col-xs-9">
			<div class="panel panel-default comentarios">
				<div class="panel-heading">
					<a href="/usuarios/{{$comentario->usuario->nomeUsuario}}"> <strong>{{$comentario->usuario->nomeUsuario}}</strong> </a>
					<small>{{$comentario->dataCriacao}}</small>
				</div>
				<div class="panel-body">
					<span class="comentario">{{$comentario->comentario}}</span>
				</div>
				@if ($comentario->usuario == \Auth::User())
				<div class="panel-footer">
					<a id="link-editar" href="#" data-toggle="modal" data-target="#comentarioModal"><i class="fa fa-pencil"></i> Editar</a>
					<a href="#" id="btn-excluirComentario" data-url="{{route('excluirComentario', $comentario->idComentario)}}" data-toggle="confirmation"><i class="fa fa-trash-o"></i> Excluir</a>
				</div>
				@endif
			</div>
		</div>
	</div>
	@endforeach
</div>
@stop

@section('scripts')
<script src="{{asset('js/bootstrap-confirmation.min.js')}}"></script>
<script src="{{asset('js/lista.js')}}"></script>
@stop