@extends('layout.principal')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.min.css')}}">	
<link rel="stylesheet" type="text/css" href="{{asset('css/stylesheet.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}"/>
@stop

@section('conteudo')
<div>
	@if (!empty($errors->all()))
	<div class="alert alert-danger">
		<span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign"></span>
		<strong>Erro ao realizar cadastro da sugestão.</strong>
	</div>
	@endif
	@if (Session::has('sucesso'))
		<div class="alert alert-success">
			<span aria-hidden="true" class="glyphicon glyphicon-ok"></span>
			<strong>Sucesso - </strong> {{ Session::get('sucesso') }}
		</div>
	@endif
	<form action="{{route('jogo.sugestao.submit')}}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{csrf_token()}}" />

		<div class="form-group{{ $errors->has('nomeJogo') ? ' has-error' : '' }}">
			<label for="nomeJogo" class="control-label">Título do jogo*</label>
			<input id="nomeJogo" name="nomeJogo" class="form-control" autofocus value="{{ old('nomeJogo') }}" required maxlength="120" />
			@if ($errors->has('nomeJogo'))
			<span class="help-block">
				<strong>{{ $errors->first('nomeJogo') }}</strong>
			</span>
			@endif
		</div>
		<div class="form-group{{ $errors->has('dataLancamento') ? ' has-error' : '' }}">
			<label for="dataLancamento" class="control-label">Data de lançamento do jogo*</label>
			<input id="dataLancamento" name="dataLancamento" class="form-control" value="{{ old('dataLancamento') }}" required maxlength="10" autocomplete="off" placeholder="dd/mm/aaaa" />
			@if ($errors->has('dataLancamento'))
			<span class="help-block">
				<strong>{{ $errors->first('dataLancamento') }}</strong>
			</span>
			@endif
		</div>

		<div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
			<label for="descricao" class="control-label">Descrição do jogo*</label>
			<textarea id="descricao" name="descricao" class="form-control" rows="5" required>{{ old('descricao') }}</textarea>
			@if ($errors->has('descricao'))
			<span class="help-block">
				<strong>{{ $errors->first('descricao') }}</strong>
			</span>
			@endif
		</div>
		<div class="form-group{{ $errors->has('quantidadeJogadores') ? ' has-error' : '' }}">
			<label class="control-label">Quantidade de jogadores*</label>
			<div>
				<label class="radio-inline"> 
					<input type="radio" name="quantidadeJogadores" value='Singleplayer' required  @if(old('quantidadeJogadores') ==  'Singleplayer') checked="checked" @endif /> Singleplayer
				</label>
				<label class="radio-inline"> 
					<input type="radio" name="quantidadeJogadores" value='Multiplayer' required  @if(old('quantidadeJogadores') ==  'Multiplayer') checked="checked" @endif /> Multiplayer
				</label>
			</div>
			@if ($errors->has('quantidadeJogadores'))
			<span class="help-block">
				<strong>{{ $errors->first('quantidadeJogadores') }}</strong>
			</span>
			@endif
		</div>
		<div class="form-group{{ $errors->has('categorias') ? ' has-error' : '' }}">
			<label for="categorias" class="control-label">Categorias</label>
			<select class="form-control select2CategoriaAjax" name="categorias[]" multiple="multiple" required>
				<option></option>
			</select>
			@if ($errors->has('categorias'))
			<span class="help-block">
				<strong>{{ $errors->first('categorias') }}</strong>
			</span>
			@endif
		</div>
		<div class="form-group{{ $errors->has('distribuidora') ? ' has-error' : '' }}">
			<label for="distribuidora" class="control-label">Distribuidora do jogo</label>
			<select class="form-control select2DistribuidoraAjax" name="distribuidora" required>
				<option></option>
			</select>
			@if ($errors->has('distribuidora'))
			<span class="help-block">
				<strong>{{ $errors->first('distribuidora') }}</strong>
			</span>
			@endif
		</div>

		<div class="form-group{{ $errors->has('desenvolvedor') ? ' has-error' : '' }}">
			<label for="desenvolvedor" class="control-label">Desenvolvedor</label>
			<select class="form-control select2DesenvolvedorAjax" name="desenvolvedor" required>
				<option></option>
			</select>
			@if ($errors->has('desenvolvedor'))
			<span class="help-block">
				<strong>{{ $errors->first('desenvolvedor') }}</strong>
			</span>
			@endif
		</div>

		<div class="form-group">
			<label for="imagem">Imagem: </label>
			<input type="file" name="imagemJogo">
		</div>

		<button class="btn btn-primary" type="submit">Cadastrar</button>
	</form>
</div>
@stop


@section('scripts')
	<script src="{{asset('js/jquery-ui.min.js')}}"></script>
	<script src="{{asset('js/select2.min.js')}}"></script>
	<script src="{{asset('js/pt-BR.js')}}"></script>
	<script src="{{asset('js/cadastroJogos.js')}}"></script>
@stop