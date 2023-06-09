@extends('layouts.app')

@section('content')

	<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
		@csrf
		<span class="login100-form-title">
			Log in Account 
		</span>

		<div class="wrap-input100 validate-input" data-validate = "@error('username') {{$message}} @enderror">
			<input class="input100" placeholder="No Kartu Keluarga / Email" id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
			<span class="focus-input100"></span>
			<span class="symbol-input100">
				<i class="fa fa-user-circle-o" aria-hidden="true"></i>
			</span>
		</div>

		<div class="wrap-input100 validate-input" data-validate = "@error('password') {{$message}} @enderror">
			<input class="input100" placeholder="Password" type="password" name="password" required autocomplete="current-password">
			<span class="focus-input100"></span>
			<span class="symbol-input100">
				<i class="fa fa-lock" aria-hidden="true"></i>
			</span>
		</div>

		@error('username')
			<div class="txtDanger text-center"> 
					<span role="alert">
							<strong>{{ $message }}</strong>
					</span>
			</div>
		@enderror
		
		<div class="container-login100-form-btn">
			<button class="login100-form-btn" type="submit">
				Login
			</button>
		</div>

	</form>

@endsection
