<div class="container jogos">
@foreach($jogos as $jogo)
	<div class="col-lg-3 col-md-4 col-sm-6">
		<div class="thumbnail">
			<a href="{{route('jogos.single', $jogo->nomeJogo)}}">
				<img src="{{asset('images/jogos/'.$jogo->imagemJogo)}}" class="img-responsive">
			</a>
			<div class="detalhes">
				<div class="row">
					<div class="col-md-12">
						<a href="{{url('/jogos/'.$jogo->nomeJogo)}}">
							<h5>{{str_limit($jogo->nomeJogo, 30)}}</h5>
						</a>
					</div>
					<div class="col-xs-6">
						<p><strong>{{$jogo->notaMedia}}</strong> <i class="fa fa-star"></i> 
						<small> - <a href="{{url('/jogos/'.$jogo->nomeJogo)}}#criticas">{{$jogo->numCriticas}} <span>{{str_plural('critica',$jogo->numCriticas)}}</span></small></a></p>
					</div>
					<div class="col-xs-6 text-right">
						<small><i class="fa fa-calendar"></i> {{$jogo->dataLancamento}}</small>
					</div>
				</div>
			</div>
		</div>
	</div>
@endforeach
</div>
{{ $jogos->links() }}