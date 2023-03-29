<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>Login Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('./login-asset/images/icons/favicon.ico"')}}/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./login-asset/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./login-asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./login-asset/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('./login-asset/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./login-asset/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./login-asset/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('./login-asset/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">				
				<div class="login100-pic">
					<p class="login100-form-title info-apps">SISTEM INFORMASI LAYANAN SURAT PENGHANTAR DESA BULAN</p>
					<img class="js-tilt " data-tilt src="{{asset('./img/LOGO_KABUPATEN_KLATEN.png')}}" alt="IMG">
				</div>
    			
				@yield('content')
	
			</div>
			</div>
		</div>
<!--===============================================================================================-->	
	<script src="{{asset('./login-asset/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('./login-asset/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('./login-asset/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('./login-asset/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('./login-asset/vendor/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('./login-asset/js/main.js')}}"></script>

</body>
</html>