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
    <link rel="stylesheet" type="text/css" href="{{asset('css/stylesheet.css')}}">
    @yield('styles')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            ]); ?>
    </script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/loginModal.js')}}"></script>
</head>
<body>
<!--Barra de navagação-->
@include('partials._nav')

<!--Conteúdo-->
<div class="container">
    @yield('conteudo') 
</div>

<!--Footer-->
<div>
    <hr>
    <p class="text-center">Vale a pena jogar © 2016. Todos os direitos reservados.</p>
</div>

<!-- Scripts -->
@yield('scripts')
</body>
</html>
