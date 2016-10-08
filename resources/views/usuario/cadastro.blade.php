@extends('layout.principal')

@section('conteudo')
	<div id="container-cadastro">
		<form action="/cadastrar" method="post">
			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			<div class="form-group">
				<label>Nome:</label>
				<input name="nomeUsuario" required="true" class="form-control" />
			</div>

			<div class="form-group">
				<label>E-mail:</label>
				<input type="email" name="emailUsuario" required="true" class="form-control" />
			</div>

			<div class="form-group">
				<label>Senha:</label>
				<input type="password" name="senhaUsuario" required="true" class="form-control" />
			</div>

			<div class="form-group">
				<label>Confirme sua senha:</label>
				<input type="password" name="senhaUsuario2" required="true" class="form-control" />
			</div>
			<button class="btn btn-primary btn-block" type="submit">Cadastrar</button>
		</form>
	</div>
@stop
