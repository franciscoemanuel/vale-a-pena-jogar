@extends('layout.principal')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.min.css')}}">
@stop
@section('conteudo')
	<div>
		@if (!empty($errors->all()))
			<div class="alert alert-danger">
				<span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign"></span>
				<strong>Erro ao editar usuário.</strong>
			</div>
		@endif
		@if (Session::has('sucesso'))
			<div class="alert alert-success">
				<span aria-hidden="true" class="glyphicon glyphicon-ok"></span>
				<strong>Sucesso - </strong> {{ Session::get('sucesso') }}
			</div>
		@endif
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<form action="{{route('usuario.dados.submit', $usuario->nomeUsuario)}}" method="post">
					<input type="hidden" name="_token" value="{{csrf_token()}}" />
					<div class="form-group{{ $errors->has('nomeCompletoUsuario') ? ' has-error' : '' }}">
						<label for="nomeCompletoUsuario" class="control-label">Nome Completo</label>
						<input id="nomeCompletoUsuario" name="nomeCompletoUsuario" class="form-control" autofocus value="{{ old('nomeCompletoUsuario') ? old('nomeCompletoUsuario') : $usuario->nomeCompletoUsuario }}" required maxlength="120" />
						 @if ($errors->has('nomeCompletoUsuario'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('nomeCompletoUsuario') }}</strong>
			                </span>
			            @endif
					</div>

					<div class="form-group{{ $errors->has('sexo') ? ' has-error' : '' }}">
						<label class="control-label">Sexo</label>
						<div>
							<label class="radio-inline"> 
								<input type="radio" name="sexo" value='M' required  @if(old('sexo') ==  'M' || $usuario->sexo == 'M') checked="checked" @endif /> Masculino
							</label>
							<label class="radio-inline"> 
								<input type="radio" name="sexo" value='F' required  @if(old('sexo') ==  'F' || $usuario->sexo == 'F') checked="checked" @endif /> Feminino
							</label>
							<label class="radio-inline"> 
								<input type="radio" name="sexo" value='I' required  @if(old('sexo') ==  'I' || $usuario->sexo == 'I') checked="checked" @endif /> Indefinido
							</label>
						</div>
						 @if ($errors->has('sexo'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('sexo') }}</strong>
			                </span>
			            @endif
					</div>

					<div class="form-group{{ $errors->has('nomeUsuario') ? ' has-error' : '' }}">
						<label for="nomeUsuario" class="control-label">Usuário</label>
						<input id="nomeUsuario" readonly name="nomeUsuario" class="form-control" value="{{ old('nomeUsuario') ? old('nomeUsuario') : $usuario->nomeUsuario}}" required maxlength="40" />
						 @if ($errors->has('nomeUsuario'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('nomeUsuario') }}</strong>
			                </span>
			            @endif
					</div>

					<div class="form-group{{ $errors->has('emailUsuario') ? ' has-error' : '' }}">
						<label for="emailUsuario" class="control-label">E-mail</label>
						<input id="emailUsuario" name="emailUsuario" class="form-control" type="email" value="{{ old('emailUsuario') ? old('emailUsuario') : $usuario->emailUsuario }}" required maxlength="120" />
						 @if ($errors->has('emailUsuario'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('emailUsuario') }}</strong>
			                </span>
			            @endif
					</div>

					<div class="form-group{{ $errors->has('dataNascimentoUsuario') ? ' has-error' : '' }}">
						<label for="dataNascimentoUsuario" class="control-label">Data de nascimento</label>
						<input id="dataNascimentoUsuario" name="dataNascimentoUsuario" class="form-control" value="{{ old('dataNascimentoUsuario') ? old('dataNascimentoUsuario') : $usuario->dataNascimentoUsuario }}" required maxlength="10" autocomplete="off" placeholder="dd/mm/aaaa" />
						 @if ($errors->has('dataNascimentoUsuario'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('dataNascimentoUsuario') }}</strong>
			                </span>
			            @endif
					</div>

					<div class="form-group{{ $errors->has('senhaUsuario') ? ' has-error' : '' }}">
						<label for="senhaUsuario" class="control-label">Senha</label>
						<input id="senhaUsuario" name="senhaUsuario" class="form-control" type="password" maxlength="12" />
						 @if ($errors->has('senhaUsuario'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('senhaUsuario') }}</strong>
			                </span>
			            @endif
					</div>

					<div class="form-group{{ $errors->has('senhaUsuario_confirmation') ? ' has-error' : '' }}">
						<label for="senhaUsuario_Confrimation" class="control-label">Confirme a nova senha</label>
						<input id="senhaUsuario_confirmation" name="senhaUsuario_confirmation" class="form-control" type="password" maxlength="12" />
						 @if ($errors->has('senhaUsuario_confirmation'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('senhaUsuario_confirmation') }}</strong>
			                </span>
			            @endif			
					</div>
					<input type="hidden" name="idUsuario" value="{{$usuario->idUsuario}}">	
					<button class="btn btn-primary" type="submit">Editar</button>
				</form>
				</br>
			</div>
	</div>
@stop


@section('scripts')
	    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
	    <script>
			$(function() {
				$("#dataNascimentoUsuario").datepicker({
		        dateFormat: 'dd/mm/yy',
		        changeYear: true,
		        changeMonth: true,
		        yearRange: "-100:+0",
		        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
		        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
		    });
			});
		</script>
@stop