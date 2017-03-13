<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN | Login</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('font-awesome-4.6.3/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/stylesheet.css')}}">
    <script src="{{asset('js/app.js')}}"></script>
    <style type="text/css">
        .container{
            margin-top: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Painel do administrador</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{route('admin.login.submit')}}">
                        {{ csrf_field() }}
                        @if (!empty($errors->all()))
                           <div class="alert alert-danger">
                                <span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign"></span>
                                <strong>Erro ao realizar login.</strong>
                           </div>
                        @endif   
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="senha" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Continuar conectado
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                             
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Footer-->
<div>
    <hr>
    <p class="text-center">Vale a pena jogar © 2016. Todos os direitos reservados.</p>
</div>
</body>
</html>