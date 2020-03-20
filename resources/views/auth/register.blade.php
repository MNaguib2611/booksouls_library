@extends('layouts.app')

@section('css')
<!--===============================================================================================-->
<link rel="stylesheet" href="{{asset('css/register/material-design-iconic-font.min.css')}}">
<link rel="stylesheet" href="{{asset('css/register/style.css')}}">
<!--===============================================================================================-->
@endsection

@section('content')
<div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img" >
                    <img style="height:95%;" src="{{asset('imgs/header-bg.jpg')}}" alt="">
                </div>
                <div class="signup-form">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="register-form" id="register-form">
                    @csrf   
                    <h2 style="margin-left:150px;">Sign UP</h2>
                        <div class="form-group">
                            <label for="name">Name :</label>
                            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">User Name :</label>
                            <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone :</label>
                            <input id="phone" type="text" class="@error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"   autocomplete="phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address :</label>
                            <input id="address" type="text" class="@error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
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
                        <div class="form-group">
                            <label for="password">Password :</label>
                            <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="papassword-confirmssword">Confirm Password :</label>
                            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-submit">
                            <input type="reset" value="Reset All" class="submit" name="reset" id="reset" />
                            <input type="submit" value="Submit Form" class="submit" name="submit" id="submit" />
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