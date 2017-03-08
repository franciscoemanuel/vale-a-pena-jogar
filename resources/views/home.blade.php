@extends('layout.principal')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/jogos.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/_listas.css')}}">
@stop


@section('conteudo')
<div class="jogos">
<span class="titulo">Jogos</span>
  <div class="row section">
      <div class="col-xs-10">
          <span class="subTitulo">Melhor avaliados</span>
          <small><a href="{{route('jogos.index', ['ordem' => 'notaMedia'])}}">Ver todos</a></small>
      </div>
      @foreach($jogosMelhorAvaliados as $jogo)
      <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="thumbnail">
              <a href="{{url('/jogos/'.$jogo->nomeJogo)}}">
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
  <div class="row section">
      <div class="col-xs-10">
          <span class="subTitulo">Lançados recentemente</span>
          <small><a href="#">Ver todos</a></small>
      </div>
      @foreach($jogosLancadosRecentemente as $jogo)
      <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="thumbnail">
              <a href="{{url('/jogos/'.$jogo->nomeJogo)}}">
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
  <div class="row section">
      <div class="col-xs-10">
          <span class="subTitulo">Em breve</span>
          <small><a href="#">Ver todos</a></small>
      </div>
      @foreach($jogosEmBreve as $jogo)
      <div class="col-lg-3 col-md-4 col-sm-6">
          <div class="thumbnail">
              <a href="{{url('/jogos/'.$jogo->nomeJogo)}}">
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
</div>  
<hr>
<span class="titulo">Listas</span>
<div class="row section">
    <div class="col-xs-10">
        <span class="subTitulo">Melhor avaliadas</span>
        <small><a href="#">Ver todos</a></small>
    </div>
    @foreach($listasMelhorAvaliadas as $lista)
    <div class="col-xs-12">
        <div class="well well-sm">
           <div class="row">
               <div class="col-xs-12 section-box">
                    <a href="/listas/{{$lista->idLista}}">
                   <h2>{{$lista->nomeLista}}</h2>
                   </a>
                   <p>{{$lista->descricaoLista}}</p>
                   <div class="row rating-desc">
                       <div class="col-md-8 col-xs-6">
                            <a href="/listas/{{$lista->idLista}}/#comentarios"><span class="fa fa-comments"></span> ({{$lista->qtdComentarios}} {{str_plural('comentario',$lista->qtdComentarios)}}) </a>
                                        <span class="separator">|</span>
                                        <span class="fa fa-thumbs-o-up"></span> ({{$lista->qtdCurtidas}} {{str_plural('curtida',$lista->qtdCurtidas)}})
                                        <span class="separator">|</span>
                                        <span class="fa fa-list"> </span> ({{$lista->qtdJogos}} {{str_plural('jogo',$lista->qtdJogos)}})
                       </div>
                      <div class="col-md-2 col-md-offset-2 col-xs-6 text-right">
                        <a href="{{route('usuario', $lista->usuario->nomeUsuario)}}"><small>Criada por {{$lista->usuario->nomeUsuario}}</small></a>
                      </div>
                   </div>
               </div>
           </div>
       </div>
    </div>  
    @endforeach
</div>
<div class="row section">
    <div class="col-xs-10">
        <span class="subTitulo">Mais comentadas</span>
        <small><a href="#">Ver todos</a></small>
    </div>
    @foreach($listasMaisComentadas as $lista)
    <div class="col-xs-12">
        <div class="well well-sm">
           <div class="row">
               <div class="col-xs-12 section-box">
                    <a href="/listas/{{$lista->idLista}}">
                   <h2>{{$lista->nomeLista}}</h2>
                   </a>
                   <p>{{$lista->descricaoLista}}</p>
                   <div class="row rating-desc">
                       <div class="col-md-8 col-xs-6">
                            <a href="/listas/{{$lista->idLista}}/#comentarios"><span class="fa fa-comments"></span> ({{$lista->qtdComentarios}} {{str_plural('comentario',$lista->qtdComentarios)}}) </a>
                                        <span class="separator">|</span>
                                        <span class="fa fa-thumbs-o-up"></span> ({{$lista->qtdCurtidas}} {{str_plural('curtida',$lista->qtdCurtidas)}})
                                        <span class="separator">|</span>
                                        <span class="fa fa-list"> </span> ({{$lista->qtdJogos}} {{str_plural('jogo',$lista->qtdJogos)}})
                       </div>
                      <div class="col-md-2 col-md-offset-2 col-xs-6 text-right">
                        <a href="{{route('usuario', $lista->usuario->nomeUsuario)}}"><small>Criada por {{$lista->usuario->nomeUsuario}}</small></a>
                      </div>
                   </div>
               </div>
           </div>
       </div>
    </div>  
    @endforeach
</div>
@stop

@section('scripts')
@stop
