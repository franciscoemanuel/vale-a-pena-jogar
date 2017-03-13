@extends('layout.principal')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/usuarios.css')}}">
@stop
@section('conteudo')
<div class="row">
	<div class="col-xs-8 col-md-4">
	    <div class="row pesquisa">
	        <form class="form-horizontal" role="form">
	            <div class="col-md-12">
	                <div class="input-group" id="adv-search">
	                    <input name="busca" type="text" class="form-control" placeholder="Procurar..." value="{{ request('busca') }}"/>
	                    <div class="input-group-btn">
	                        <div class="btn-group" role="group">
	                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </form>
	    </div>
	</div>
</div>
<div class="container">
	<div class="row">
		@foreach($usuarios as $usuario)
		<div class="col-lg-3 col-md-4 col-sm-6 profile">
		  <div class="img-box">
		    <img src="{{asset('images/usuarios/avatar.png')}}" class="img-responsive img-circle">
		    <ul class="text-center">
		      <a href="{{route('usuario', $usuario->nomeUsuario)}}#jogos"><span class="badge">{{$usuario->jogos->count()}} {{str_plural('jogos',$usuario->jogos->count())}}</span><li><i class="fa fa-gamepad"></i></li></a>
		      <a href="{{route('usuario', $usuario->nomeUsuario)}}#listas"><span class="badge">{{$usuario->listas->count()}} {{str_plural('listas',$usuario->listas->count())}}</span><li><i class="fa fa-list-ol"></i></li></a>
		      <a href="{{route('usuario', $usuario->nomeUsuario)}}#criticas"><span class="badge">{{$usuario->criticas->count()}} {{str_plural('criticas',$usuario->criticas->count())}}</span><li><i class="fa fa-star-half-o"></i></li></a>
		    </ul>
		  </div>
		  <a href="{{route('usuario', $usuario->nomeUsuario)}}"><h1>{{str_limit($usuario->nomeUsuario, 31)}}</h1></a>
		  <h2><span>{{$usuario->sexoFormatado}}</span>, <span>{{$usuario->idade}}</span></h2>
		</div>
		@endforeach
	</div>
</div>
<div class="col-xs-4">
{{$usuarios->links()}}
</div>
@stop


@section('scripts')

@stop