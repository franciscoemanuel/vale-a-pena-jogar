@extends('layout.principal')

@section('titulo', '| Jogos')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{asset('css/jogos.css')}}">
@stop

@section('conteudo')
	<div class="row">
		@foreach($jogos as $jogo)
		<div class="col-md-3 col-sm-4">
			<div class="thumbnail">
				<a href="{{url('/jogos/'.$jogo->nomeJogo)}}">
					<img src={{asset('images/placeholder.png')}} class="img-responsive">
				</a>
				<div class="detalhes">
					<div class="row">
						<div class="col-md-12">
							<a href="{{url('/jogos/'.$jogo->nomeJogo)}}">
								<h5>{{$jogo->nomeJogo}}</h5>
							</a>
							<p><strong>{{$jogo->notaMedia}}</strong> <i class="fa fa-star"></i> <small> - <a href="{{url('/jogos/'.$jogo->nomeJogo)}}#criticas">{{$jogo->numCriticas}} {{str_plural('critica',$jogo->numCriticas)}}</small></a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	{{ $jogos->links() }}
@stop
