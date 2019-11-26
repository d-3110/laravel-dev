@php
    $url = route('register');
@endphp

@extends('layouts.template')

@section('title','register')
@section('description','ディスクリプション')
@section('page_style')
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
@stop
@include('head')
<!-- FORGOT PASSWORD FORM -->
<div class="text-center" style="padding:50px 0">
    <div class="logo">forgot password</div>
    <!-- Main Form -->
    <div class="login-form-1">
        <form id="forgot-password-form" class="text-left" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="etc-login-form">
                <p>When you fill in your registered email address, you will be sent instructions on how to reset your password.</p>
            </div>
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email fp_email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="email address">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="sr-only">Password</label>
                            <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    </div>
                </div>
                <button type="submit" class="login-button"><i class="fa fare-chevron-right"></i></button>
            </div>
            <div class="etc-login-form">
                <p>already have an account? <a href="#">login here</a></p>
                <p>new user? <a href="#">create new account</a></p>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
</div>
@include('script')