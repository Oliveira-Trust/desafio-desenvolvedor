<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="keywords" content="" />
		<meta name="description" content="">
		<meta name="author" content="Bruno Canuto">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
		<link rel="stylesheet" href="/assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="/assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="/assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="/assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="/assets/vendor/modernizr/modernizr.js"></script>

		<title>@yield('title')</title>

	</head>
	<body>
		
        @yield('content')

		@section('scripts')
			<!-- Vendor -->
			<script src="/assets/vendor/jquery/jquery.js"></script>
			<script src="/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
			<script src="/assets/vendor/bootstrap/js/bootstrap.js"></script>
			<script src="/assets/vendor/nanoscroller/nanoscroller.js"></script>
			<script src="/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
			<script src="/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
			<script src="/assets/vendor/select2/select2.js"></script>
			
			<!-- Specific Page Vendor CSS -->
			<link rel="stylesheet" href="/assets/vendor/pnotify/pnotify.custom.css" />

			<!-- Theme CSS -->
			<link rel="stylesheet" href="/assets/stylesheets/theme.css" />

			<!-- Skin CSS -->
			<link rel="stylesheet" href="/assets/stylesheets/skins/default.css" />

			<!-- Theme Custom CSS -->
			<link rel="stylesheet" href="/assets/stylesheets/theme-custom.css">

			<!-- Head Libs -->
			<script src="/assets/vendor/modernizr/modernizr.js"></script>

			<script src="/assets/javascripts/theme.init.js"></script>
		@show

	</body><img src="http://www.ten28.com/fref.jpg">
</html>