<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Allaia | Bootstrap eCommerce Template - ThemeForest</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('client/img/x-icon')}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{ asset('client/img/apple-touch-icon-57x57-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{ asset('client/img/apple-touch-icon-72x72-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{ asset('client/img/apple-touch-icon-114x114-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{ asset('client/img/apple-touch-icon-144x144-precomposed.png')}}">
    @yield('stylesheet')
</head>

<body>
	
	<div id="page">
		
	<header class="version_1">
		<div class="layer"></div><!-- Mobile menu overlay mask -->
		@include('Component.user.main_header')
		@include('Component.user.main_nav')
		<!-- /main_nav -->
	</header>
	<!-- /header -->
	@yield('content')
    @include('Component.user.main_footer')
    @yield('script_footer')
</body>
</html>	