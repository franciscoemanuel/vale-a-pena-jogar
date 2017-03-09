@extends('layout.admin')

@section('conteudo')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Dashboard</div>

                <div class="panel-body">
                    Bem-vindo {{Auth::guard('admin')->user()->email}}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
