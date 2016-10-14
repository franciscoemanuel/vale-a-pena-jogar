@extends('layout.principal')

@section('conteudo')
	<div class="container-cadastro">
		@if (!empty($errors->all()))
			<div class="alert alert-danger">
				<span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign"></span>
				<strong>Erro ao realizar cadastro.</strong>
			</div>
		@endif
		<form action="/cadastro" method="post">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			
			<div class="form-group{{ $errors->has('nomeCompletoUsuario') ? ' has-error' : '' }}">
				<label for="nomeCompletoUsuario" class="control-label">Nome Completo:</label>
				<input id="nomeCompletoUsuario" name="nomeCompletoUsuario" class="form-control" autofocus value="{{ old('nomeCompletoUsuario') }}" required maxlength="120" />
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
						<input type="radio" name="sexo" value='M' required  @if(old('sexo') ==  'M') checked="checked" @endif /> Masculino
					</label>
					<label class="radio-inline"> 
						<input type="radio" name="sexo" value='F' required  @if(old('sexo') ==  'F') checked="checked" @endif /> Feminino
					</label>
					<label class="radio-inline"> 
						<input type="radio" name="sexo" value='I' required  @if(old('sexo') ==  'I') checked="checked" @endif /> Indefinido
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
				<input id="nomeUsuario" name="nomeUsuario" class="form-control" value="{{ old('nomeUsuario') }}" required maxlength="40" />
				 @if ($errors->has('nomeUsuario'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nomeUsuario') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('emailUsuario') ? ' has-error' : '' }}">
				<label for="emailUsuario" class="control-label">E-mail:</label>
				<input id="emailUsuario" name="emailUsuario" class="form-control" type="email" value="{{ old('emailUsuario') }}" required maxlength="120" />
				 @if ($errors->has('emailUsuario'))
                    <span class="help-block">
                        <strong>{{ $errors->first('emailUsuario') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('senhaUsuario') ? ' has-error' : '' }}">
				<label for="senhaUsuario" class="control-label">Senha:</label>
				<input id="senhaUsuario" name="senhaUsuario" class="form-control" type="password" required maxlength="12" />
				 @if ($errors->has('senhaUsuario'))
                    <span class="help-block">
                        <strong>{{ $errors->first('senhaUsuario') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group{{ $errors->has('senhaUsuario_confirmation') ? ' has-error' : '' }}">
				<label for="senhaUsuario_Confrimation" class="control-label">Confirme sua senha:</label>
				<input id="senhaUsuario_confirmation" name="senhaUsuario_confirmation" class="form-control" type="password" required maxlength="12" />
				 @if ($errors->has('senhaUsuario_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('senhaUsuario_confirmation') }}</strong>
                    </span>
                @endif			
			</div>

			<button class="btn btn-primary btn-block" type="submit">Cadastrar</button>

		</form>
	</div>
@stop
