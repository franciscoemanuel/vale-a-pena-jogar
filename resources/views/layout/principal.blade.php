<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VAPJ @yield('titulo')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('font-awesome-4.6.3/css/font-awesome.min.css')}}">
    @yield('styles')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            ]); ?>
    </script>
    <script src="{{asset('js/app.js')}}"></script>
</head>
<body>
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
                <li {{ Request::is('grupos') ? 'class = active ' : null }} ><a href="/grupos"><i class="fa fa-users"></i> Grupos</a></li>
                <li {{ Request::is('noticias') ? 'class = active ' : null }} ><a href="/noticias"><i class="fa fa-newspaper-o"></i> Notícias</a></li>
            </ul>
            <!-- Right Side Of Navbar -->
            <div class="container">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li><a href="{{ url('/login') }}"><span class="glyphicon glyphicon-user"></span> Login </a></li>

                    <li><a href="{{ url('/cadastro') }}"><span class="glyphicon glyphicon-log-in"></span> Cadastre-se </a></li>
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
                                Logout
                            </a>

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

<div class="container">
    @yield('conteudo') 
    <!--Footer-->
</div>
<div>
    <hr>
    <p class="text-center">Vale a pena jogar © 2016. Todos os direitos reservados.</p>
</div>
<!-- Scripts -->
@yield('scripts')
</body>
</html>
