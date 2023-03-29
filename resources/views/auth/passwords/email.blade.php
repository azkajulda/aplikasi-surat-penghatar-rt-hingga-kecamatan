@extends('layouts.app')

@section('content')

    <form class="login100-form validate-form" method="POST" action="{{ route('password.email') }}">
		@csrf
		<span class="login100-form-title">
			Reset Password
		</span>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

		<div class="wrap-input100 validate-input">
			<input class="input100" placeholder="Email" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
			<span class="focus-input100"></span>
			<span class="symbol-input100">
				<i class="fa fa-envelope" aria-hidden="true"></i>
			</span>
		</div>

        @error('email')
            <div class="txtDanger text-center"> 
                <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </div>
        @enderror

		
		
		<div class="container-login100-form-btn">
			<button class="login100-form-btn" type="submit">
				Send Password Reset Link
			</button>
		</div>

        <div class="text-center p-t-50">
			<a class="txt2" href="{{ route('login') }}">
				<i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i> Back To Login Page
			</a>
		</div>
	</form>
    
@endsection
