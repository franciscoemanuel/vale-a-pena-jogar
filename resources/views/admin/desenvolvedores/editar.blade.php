@extends('layout.admin')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pesquisa.css')}}">
@stop

@section('conteudo')
<div>
	@if (!empty($errors->all()))
	<div class="alert alert-danger">
		<span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign"></span>
		<strong>Erro ao editar.</strong>
	</div>
	@endif
	<form action="{{route('desenvolvedor.editar.submit', $desenvolvedor->idDesenvolvedor)}}" method="POST">
		<input type="hidden" name="_token" value="{{csrf_token()}}" />
		<div class="form-group{{ $errors->has('nomeDesenvolvedor') ? ' has-error' : '' }}">
				<label for="nomeDesenvolvedor" class="control-label">Nome do desenvolvedor*</label>
				<input id="nomeDesenvolvedor" name="nomeDesenvolvedor" class="form-control" autofocus value="{{$desenvolvedor->nomeDesenvolvedor}}" required maxlength="120" />
				 @if ($errors->has('nomeDesenvolvedor'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('nomeDesenvolvedor') }}</strong>
	                </span>
	            @endif
		</div>
		<input type="submit" class="btn btn-primary" value="Editar">
	</form>
</div>	
@stop

@section('scripts')
<script src="{{asset('js/pesquisa.js')}}"></script>
<script src="{{asset('js/bootstrap-confirmation.min.js')}}"></script>
<script src="{{asset('js/admin.js')}}"></script>
@stop