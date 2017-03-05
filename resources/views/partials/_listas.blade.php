<div class="row listas">	
	@foreach($listas as $lista)
	<div class="col-xs-12">
		<div class="well well-sm">
           <div class="row">
               <div class="col-xs-12 section-box">
               		<a href="/listas/{{$lista->idLista}}">
                   <h2>{{$lista->nomeLista}}</h2>
                   </a>
                   <p>{{$lista->descricaoLista}}</p>
                   <div class="row rating-desc">
                       <div class="col-md-8">
                       		<a href="/listas/{{$lista->idLista}}/#comentarios"><span class="fa fa-comments"></span> ({{$lista->qtdComentarios}} {{str_plural('comentario',$lista->qtdComentarios)}}) </a>
            							<span class="separator">|</span>
            							<span class="fa fa-thumbs-o-up"></span> ({{$lista->qtdCurtidas}} {{str_plural('curtida',$lista->qtdCurtidas)}})
            							<span class="separator">|</span>
            							<span class="fa fa-list"> </span> ({{$lista->qtdJogos}} {{str_plural('jogo',$lista->qtdJogos)}})
                       </div>
                      <div class="col-xs-2 col-xs-offset-2 text-right">
       					<a href="{{route('usuario', $lista->usuario->nomeUsuario)}}"><small>Criada por {{$lista->usuario->nomeUsuario}}</small></a>
                      </div>
                   </div>
               </div>
           </div>
       </div>
	</div>	
	@endforeach
</div>
{{ $listas->links() }}