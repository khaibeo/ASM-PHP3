<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>@yield('title')</title> 

    <link rel="shortcut icon" href="{{ asset('client/img/x-icon')}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('client/img/apple-touch-icon-57x57-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ asset('client/img/apple-touch-icon-72x72-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{ asset('client/img/apple-touch-icon-114x114-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{ asset('client/img/apple-touch-icon-144x144-precomposed.png')}}">
	
    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('client/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('client/css/style.css')}}" rel="stylesheet">

	<!-- SPECIFIC CSS -->
    @yield('stylesheets')

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('client/css/custom.css')}}" rel="stylesheet">

  

</head>

<body>
	
	<div id="page">
		
	@include('Component.user.main_header', ['categories' => $categories])
	<!-- /header -->
		
	@yield('content')
	<!-- /main -->
		
	@include('Component.user.main_footer')
	<!--/footer-->
	</div>
	<!-- page -->
	
	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- COMMON SCRIPTS -->
<script src="{{ asset('client/js/common_scripts.min.js')}}"></script>
<script src="{{ asset('client/js/main.js')}}"></script>

<!-- SPECIFIC SCRIPTS -->
    @yield('scripts')

</body>
</html>