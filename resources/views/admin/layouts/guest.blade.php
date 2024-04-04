<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
	    <title> @yield('title') - {{ config('app.name') }}</title>

		<!-- Site favicon -->
        <!-- 
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="{{ asset('admin/vendors/images/apple-touch-icon.png"') }}
		/>
       
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="{{ asset('admin/vendors/images/favicon-32x32.png"') }}
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="{{ asset('admin/vendors/images/favicon-16x16.png"') }}
		/>
        -->

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/styles/core.css') }} " />
		<link
			rel="stylesheet"
			type="text/css"
			href="{{ asset('admin/vendors/styles/icon-font.min.css')}} "
		/>
		<link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/styles/style.css') }}" />

	</head>
	<body class="login-page">
		
        @yield('content')

		<!-- welcome modal end -->
		<!-- js -->
		<script src="{{asset('admin/vendors/scripts/core.js')}}"></script>
		<script src="{{asset('admin/vendors/scripts/script.min.js')}}"></script>
		<script src="{{asset('admin/vendors/scripts/process.js')}}"></script>
		<script src="{{asset('admin/vendors/scripts/layout-settings.js')}}"></script>
	
	</body>
</html>
