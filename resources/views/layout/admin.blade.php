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
	<link rel="stylesheet" type="text/css" href="{{asset('css/dashboard.css')}}">
	@yield('styles')
	<!-- Scripts -->
	<script>
	    window.Laravel = <?php echo json_encode([
	        'csrfToken' => csrf_token(),
	        ]); ?>
	</script>
	<script src="{{asset('js/app.js')}}"></script>
	<script src="{{asset('js/_admin_sidebar.js')}}"></script>
</head>
<body>

<!--SIDEBAR-->
@include('partials._admin_sidebar')

@yield('scripts')
</body>
</html>