@extends('layout.admin')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pesquisa.css')}}">
@stop

@section('conteudo')
<div class="col-xs-4">
{{$desenvolvedores->links()}}
</div>

<div class="col-xs-4">
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

<div class="col-xs-4">
<a href="{{route('desenvolvedor.cadastro')}}" class="btn btn-primary pull-right">
    Novo  <i class="glyphicon glyphicon-plus"></i>
</a> 
</div>
<table class="table table-striped">
    <tr>
    	<th>ID</th>
        <th>Desenvolvedor</th>
        <th></th>
    </tr>
    @foreach($desenvolvedores as $desenvolvedor)
    <tr>
    	<td>{{$desenvolvedor->idDesenvolvedor}}</td>
        <td>{{$desenvolvedor->nomeDesenvolvedor}}</td>
        <td>
            <a href="{{route('desenvolvedor.editar', $desenvolvedor->idDesenvolvedor)}}"><i class="fa fa-pencil"></i></a>
            <a href="#" data-toggle="confirmation" data-url="{{route('desenvolvedor.excluir', $desenvolvedor->idDesenvolvedor)}}"><i class="fa fa-trash-o"></i></a>
        </td>
    </tr>
    @endforeach
</table>
@stop

@section('scripts')
<script src="{{asset('js/pesquisa.js')}}"></script>
<script src="{{asset('js/bootstrap-confirmation.min.js')}}"></script>
<script src="{{asset('js/admin.js')}}"></script>
@stop