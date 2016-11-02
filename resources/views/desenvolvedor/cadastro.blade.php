@extends('layout.principal')


@section('conteudo')
	<div class="container">
		@if (!empty($errors->all()))
		<div class="alert alert-danger">
			<span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign"></span>
			<strong>Erro ao realizar cadastro.</strong>
		</div>
		@endif
		<form action={{url('/desenvolvedores/cadastro')}} method="POST">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<div class="form-group{{ $errors->has('nomeDesenvolvedor') ? ' has-error' : '' }}">
					<label for="nomeDesenvolvedor" class="control-label">Nome do desenvolvedor*</label>
					<input id="nomeDesenvolvedor" name="nomeDesenvolvedor" class="form-control" autofocus value="{{ old('nomeDesenvolvedor') }}" required maxlength="120" />
					 @if ($errors->has('nomeDesenvolvedor'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('nomeDesenvolvedor') }}</strong>
		                </span>
		            @endif
			</div>
			<input type="submit" class="btn btn-primary" value="Cadastrar">
		</form>
	</div>	
@stop