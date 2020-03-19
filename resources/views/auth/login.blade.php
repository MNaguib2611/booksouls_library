@extends('layouts.app')

@section('css')
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('css/login/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="{{asset('css/login/bootstrap/css/bootstrap.min.css')}}fonts/font-awesome-4.7.0/css/font-awesome.min.css"> -->
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css"> -->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/login/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('css/login/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/login/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/login/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('css/login/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/login/css/main.css')}}">
<!--===============================================================================================-->
@endsection

@section('content')
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                @if (session()->has('inActive'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('inActive') }}
                </div>
                @endif
				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf
					<span class="login100-form-title p-b-34">
						Account Login
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
                        <input id="username"  type="text" class="input100 @error('username') is-invalid @enderror "  name="username" value="{{ old('username') }}" required autocomplete="username" maxlength="191" autofocus placeholder="user Name">
                        <span class="focus-input100"></span>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                     
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
                        <input id="password" type="password" class="input100  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        <span class="focus-input100"></span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="container-login100-form-btn">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Sign in
						</button>
					</div>
					<div class="w-full text-center p-t-27 p-b-239">
                        @if (Route::has('password.request'))
                            <span class="txt1">
                                Forgot
                            </span>

                            <a href="{{ route('password.request') }}" class="txt2">
                                your password?
                            </a>
                        @endif
                    
                        <input class="form-check-input" style="margin-left:5px;" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="txt2" for="remember" style="margin-left:25px;">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    

					<div class="w-full text-center">
						<a href="{{ route('register') }}" class="txt3">
							Sign Up
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url({{asset('imgs/header-bg.jpg')}});"></div>
			</div>
		</div>
	</div>
@endsection
