@extends('layout.admin')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pesquisa.css')}}">
@stop

@section('conteudo')
<div class="col-xs-4">
{{$usuarios->links()}}
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

<table class="table table-striped">
    <tr>
    	<th>ID</th>
    	<th>E-mail</th>
    	<th>Usuário</th>
        <th>Sexo</th>
        <th>Data de nascimento</th>
        <th></th>
    </tr>
    @foreach($usuarios as $usuario)
    <tr>
    	<td>{{$usuario->idUsuario}}</td>
        <td>{{$usuario->emailUsuario}}</td>
        <td>{{$usuario->nomeUsuario}}</td>
        <td>{{$usuario->sexo}}</td>
        <td>{{$usuario->dataNascimentoUsuario}}</td>
        <td>
            <a href="{{route('usuario.editar', $usuario->nomeUsuario)}}"><i class="fa fa-pencil"></i></a>
            <a href="#" data-toggle="confirmation" data-url="{{route('usuario.excluir', $usuario->idUsuario)}}"><i class="fa fa-trash-o"></i></a>
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