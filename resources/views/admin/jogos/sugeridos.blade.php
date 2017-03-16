@extends('layout.admin')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pesquisa.css')}}">
@stop

@section('conteudo')
<div class="col-xs-4">
{{$jogos->links()}}
</div>

<div class="col-xs-4">
<div class="row pesquisa">
    <form class="form-horizontal" role="form">
        <div class="col-md-12">
            <div class="input-group" id="adv-search">
                <input name="busca" type="text" class="form-control" placeholder="Procurar jogos..." value="{{ request('busca') }}"/>
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                  <div class="form-group">
                                    <label for="filter">Ordernar por: </label>
                                    <select name="ordem" class="form-control">
                                        <option value="notaMedia" {{request('ordem') == 'notaMedia' ? 'selected' : ''}}>Nota média</option>
                                        <option value="dataLancamento" {{request('ordem') == 'dataLancamento' ? 'selected' : ''}}>Data de lançamento</option>
                                        <option value="nomeJogo" {{request('ordem') == 'nomeJogo' ? 'selected' : ''}}>Ordem alfabética</option>
                                    </select>
                                  </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>


@if (Session::has('sucesso'))
<div class="col-xs-12">
    <div class="alert alert-success">
        <span aria-hidden="true" class="glyphicon glyphicon-ok"></span>
        <strong>Sucesso - </strong> {{ Session::get('sucesso') }}
    </div>
</div>
@endif
@if(sizeof($jogos) > 0)
<table class="table table-striped">
    <tr>
        <th>Titulo</th>
        <th>Data de lançamento</th>
        <th>Desenvolvedor</th>
        <th>Distribuidora</th>
        <th>Imagem</th>
        <th></th>
    </tr>
    @foreach($jogos as $jogo)
    <tr>
        <td><a target="_blank" href="{{route('jogos.single', $jogo->nomeJogo)}}">{{$jogo->nomeJogo}}</a></td>
        <td>{{$jogo->dataLancamento}}</td>
        <td>{{$jogo->desenvolvedor->nomeDesenvolvedor}}</td>
        <td>{{$jogo->distribuidora->nomeDistribuidora}}</td>
        <td>{{$jogo->imagemJogo}}</td>
        <td>
            <a href="{{route('admin.jogos.aprovar', $jogo->nomeJogo)}}"><i class="fa fa-eye"></i></a>
            <a href="#" data-toggle="confirmation" data-url="{{route('jogo.excluir', $jogo->idJogo)}}"><i class="fa fa-trash-o"></i></a>
        </td>
    </tr>
    @endforeach
</table>
@else
<div class="col-xs-12">
<h2>Sem jogos para aprovação</h2>
<hr>
</div>
@endif
@stop
@section('scripts')
<script src="{{asset('js/pesquisa.js')}}"></script>
<script src="{{asset('js/bootstrap-confirmation.min.js')}}"></script>
<script src="{{asset('js/admin.js')}}"></script>
@stop