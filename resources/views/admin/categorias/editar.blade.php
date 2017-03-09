@extends('layout.admin')


@section('conteudo')
	<div>
		@if (!empty($errors->all()))
		<div class="alert alert-danger">
			<span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign"></span>
			<strong>Erro ao realizar cadastro.</strong>
		</div>
		@endif
		<form action="{{route('categoria.editar', $categoria->idCategoria)}}" method="POST">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<div class="form-group{{ $errors->has('nomeCategoria') ? ' has-error' : '' }}">
					<label for="nomeCategoria" class="control-label">Nome da categoria*</label>
					<input id="nomeCategoria" name="nomeCategoria" class="form-control" autofocus value="{{ $categoria->nomeCategoria }}" required maxlength="120" />
					 @if ($errors->has('nomeCategoria'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('nomeCategoria') }}</strong>
		                </span>
		            @endif
			</div>
			<input type="submit" class="btn btn-primary" value="Editar">
		</form>
	</div>	
@stop