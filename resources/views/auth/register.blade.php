@extends('layouts.app')

@section('css')
<!--===============================================================================================-->
<link rel="stylesheet" href="{{asset('css/register/material-design-iconic-font.min.css')}}">
<link rel="stylesheet" href="{{asset('css/register/style.css')}}">
<!--===============================================================================================-->
@endsection

@section('content')
<div class="main">
        <div class="container singup-container">
            <div class="signup-content">
                <div class="signup-form">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="register-form" id="register-form">
                    @csrf   
                    <h2 style="margin:auto; margin-bottom: 2rem; margin-left:40%">Sign UP</h2>
                        <div class="form-group">
                            <input id="name" type="text" placeholder="Name" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <span class="focus-input100"></span>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="username" type="text" placeholder="Username" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                            <span class="focus-input100"></span>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="email" type="email" placeholder="Email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <span class="focus-input100"></span>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="phone" type="text" placeholder="Phone Number" class="@error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"   autocomplete="phone">
                            <span class="focus-input100"></span>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="address" type="text" placeholder="Address" class="@error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
                            <span class="focus-input100"></span>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar :</label>
                            <input id="avatar" type="file" class=" @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}">
                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mt-5">
                            <input id="password" type="password" placeholder="Password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <span class="focus-input100"></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                            <span class="focus-input100"></span>
                        </div>
                        <div class="form-submit">
                            <input type="submit" value="Submit Form" class="submit mb-1" name="submit" id="submit" />
                            <input type="reset" value="Reset All" class="submit" name="reset" id="reset" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!--===============================================================================================-->
    <script  src="{{asset('js/register/jquery.min.js')}}"></script>
    <script  src="{{asset('js/register/main.js')}}"></script>
    <!--===============================================================================================-->
@endsection