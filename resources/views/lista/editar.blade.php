@extends('layout.principal')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}"/>
@stop

@section('conteudo')
@if (!empty($errors->all()))
	<div class="alert alert-danger">
		<span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign"></span>
		<strong>Erro ao Editar.</strong>
	</div>
@endif
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<form method="POST" action={{route('editarLista', $lista->idLista)}}>
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<div class="form-group{{ $errors->has('nomeLista') ? ' has-error' : '' }}">
				<label for="nomeLista">Nome (título) da lista:</label>
				<input required id="nomeLista" name="nomeLista" type="text"  value="{{$lista->nomeLista}}" class="form-control" autofocus>
				 @if ($errors->has('nomeLista'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('nomeLista') }}</strong>
	                </span>
	            @endif
			</div>
			<div class="form-group{{ $errors->has('descricaoLista') ? ' has-error' : '' }}">
				<label for="descricaoLista">Descrição da lista:</label>
				<textarea required  id="descricaoLista" name="descricaoLista" type="text" rows="3" class="form-control">{{$lista->descricaoLista}}</textarea>
				 @if ($errors->has('descricaoLista'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('descricaoLista') }}</strong>
	                </span>
	            @endif
			</div>
			<div class="form-group{{ $errors->has('jogos') ? ' has-error' : '' }}">
				<label for="jogos" class="control-label">Jogos: </label>
				<select class="form-control select2JogosAjax" multiple="multiple" name="jogos[]" required>
					@foreach($lista->jogos as $jogo)
					<option value="{{$jogo->idJogo}}" selected>{{$jogo->nomeJogo}}</option>
					@endforeach
				</select>
				@if ($errors->has('jogos'))
				<span class="help-block">
					<strong>{{ $errors->first('jogos') }}</strong>
				</span>
				@endif
			</div>
			<input type="submit" value="Salvar" class="btn btn-primary">
		</form>
	</div>
</div>	
@stop

@section('scripts')
<script src="{{asset('js/select2.min.js')}}"></script>
<script src="{{asset('js/pt-BR.js')}}"></script>
<script src="{{asset('js/cadastroLista.js')}}"></script>
@stop