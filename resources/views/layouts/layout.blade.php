<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initialscale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title> @yield('title')</title>
	<link href="{{ asset('public/frontend/css/bootstrap.min.css')
}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/font-awesome.min.css')
}}" rel="stylesheet">
	<link href="{{ asset('public/frontend/css/prettyPhoto.css') }}"
		rel="stylesheet">
	<link href="{{ asset('public/frontend/css/price-range.css') }}"
		rel="stylesheet">
	<link href="{{ asset('public/frontend/css/animate.css') }}"
		rel="stylesheet">
	<link href="{{ asset('public/frontend/css/main.css') }}"
		rel="stylesheet">
	<link href="{{ asset('public/frontend/css/responsive.css') }}"
		rel="stylesheet">
	<link rel="shortcut icon" href="{{
asset('public/frontend/images') }}/ico/favicon.ico">
</head><!--/head-->

<body>
	<!--/header-->
	@include("layouts.elements.top")
	<!--/slider-->
	@include("layouts.elements.slide")
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					@include("layouts.elements.sidebar")
				</div>
				<div class="col-sm-9 padding-right">
					@yield('content')
				</div>
			</div>
		</div>
	</section>
	@include("layouts.elements.footer")
	<!--/Footer-->
	<script src="{{ asset('public/frontend/js/jquery.js')
}}"></script>
	<script src="{{ asset('public/frontend/js/bootstrap.min.js')
}}"></script>
	<script src="{{
asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/price-range.js')
}}"></script>
	<script src="{{
asset('public/frontend/js/jquery.prettyPhoto.js') }}"></script>
	<script src="{{ asset('public/frontend/js/main.js')
}}"></script>
</body>

</html>