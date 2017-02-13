@foreach ($criticas as $critica)
<div class="row criticasJogo" id="criticas">
	<div class="col-md-1 col-xs-2">
		<div class="thumbnail">
			<img class="img-responsive user-photo" src="{{asset('images/avatar.png')}}">
		</div><!-- /thumbnail -->
	</div>
	<div class="col-md-5 col-xs-9">
		<div class="panel panel-default comentarios">
			<div class="panel-heading">
				<a href="/usuarios/{{$critica->usuario->nomeUsuario}}"> <strong>{{$critica->usuario->nomeUsuario}}</strong> </a>
				<small>{{$critica->dataCriacao}}</small>
				<span class="notaCritica">
					<i class="fa fa-star"></i> 
					{{$critica->nota ? $critica->nota : 0}}/
					<small>5</small> 
				</span>
			</div>
			<div class="panel-body">
				<span class="comentario">{{$critica->comentario}}</span>
			</div>
			@if ($critica->usuario == \Auth::User())
			<div class="panel-footer">
					<a id="link-editar" href="#" data-toggle="modal" data-target="#criticaModal"><i class="fa fa-pencil"></i> Editar</a>
					<a href="#" data-idCritica="{{$critica->idCritica}}" data-toggle="confirmation"><i class="fa fa-trash-o"></i> Excluir</a>
			</div>
			@endif
		</div>
	</div>
</div>
@endforeach
{{$criticas->links()}}

<script>
var urlCritica = '{{route('critica')}}'
</script>