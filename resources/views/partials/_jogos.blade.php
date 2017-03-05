@foreach($jogos->chunk(3) as $linha)
<div class="row">
	@foreach($linha as $jogo)
	<div class="col-xs-4">
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
@endforeach
{{ $jogos->links() }}