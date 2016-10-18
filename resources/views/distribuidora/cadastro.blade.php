@extends('layout.principal')

@section('conteudo')
	<div class="container">
		@if (!empty($errors->all()))
		<div class="alert alert-danger">
			<span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign"></span>
			<strong>Erro ao realizar cadastro.</strong>
		</div>
		@endif
		<form action="/cadastro/distribuidoras" method="POST">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<div class="form-group{{ $errors->has('nomeDistribuidora') ? ' has-error' : '' }}">
					<label for="nomeDistribuidora" class="control-label">Nome da distribuidora*</label>
					<input id="nomeDesenvolvedor" name="nomeDistribuidora" class="form-control" autofocus value="{{ old('nomeDistribuidora') }}" required maxlength="120" />
					 @if ($errors->has('nomeDistribuidora'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('nomeDistribuidora') }}</strong>
		                </span>
		            @endif
			</div>
			<input type="submit" class="btn btn-primary" value="Cadastrar">
		</form>
	</div>	
@stop