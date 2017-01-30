<nav class="navbar navbar-default navbar-static-top">

    <div class="navbar-header">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <img style="max-width: 13%; max-height: 10%; float: left" src="{{ URL::to('/') }}/images/joystickIcone.png">
        <a class="navbar-brand" href="/">
            Vale a pena jogar?
        </a>
        <!-- Branding Image -->
    </div>
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
            <li {{ Request::is('/') ? 'class = active ' : null }} ><a href="/"><span class="glyphicon glyphicon-home"></span> Início <span class="sr-only">(current)</span></a></li>
            <li {{ Request::is('jogos') ? 'class = active ' : null }} ><a href="/jogos"><i class="fa fa-gamepad"></i> Jogos</a></li>
            <li {{ Request::is('listas') ? 'class = active ' : null }} ><a href="/listas"><span class="glyphicon glyphicon-th-list"></span> Listas</a></li>
            <li {{ Request::is('usuarios') ? 'class = active ' : null }} ><a href="/usuarios"><i class="glyphicon glyphicon-user"></i> Usuários</a></li>
        </ul>
        <!-- Right Side Of Navbar -->
        <div class="container">
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                <!-- <li><a href="{{ url('/login') }}"><span class="glyphicon glyphicon-user"></span> Login </a></li> -->
                <li><a href="#" data-toggle="modal" data-target="#loginModal"><span class="glyphicon glyphicon-user"></span> Login</a></li>
                <li><a href="{{ url('/cadastro') }}"><span class="glyphicon glyphicon-log-in"></span> Cadastre-se </a></li>
            <!--     <li><a href="#" data-toggle="modal" data-target="#registerModal">Cadastro</a></li> -->
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->nomeUsuario }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                                <a href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout</a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                     </ul>
                 </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel panel-default" style="margin-bottom: 0;">
                <div class="panel-heading">Login <i class="glyphicon glyphicon-log-in"></i></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <form action="{{url('/login')}}" method="POST" id="loginForm" novalidate>
                                <div class="form-group" id="email-div">
                                    {{ csrf_field() }}
                                    <label for="email" class="col-md-4 control-label">E-Mail</label>
                                    <input id="email" type="email" class="form-control" name="emailUsuario" value="{{ old('email') }}" required autofocus>
                                    <span class="help-block">
                                        <strong id="form-erros-email"></strong>
                                    </span>
                                </div>
                                <div class="form-group" id="senha-div">
                                    <label for="password" class="col-md-4 control-label">Senha</label>
                                    <input id="password" type="password" class="form-control" name="senhaUsuario" required>
                                    <span class="help-block">
                                        <strong id="form-erros-senha"></strong>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember">Continuar conectado
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group hidden" id="login-erros">
                                    <div class="alert alert-danger">
                                         <span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign"></span>
                                         <strong id="form-login-erros"></strong>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                                <hr>
                                    <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        Não tem uma conta? <a href={{url('/cadastro')}}> Cadastre-se »</a>
                                    </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
