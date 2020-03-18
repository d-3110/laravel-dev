@extends('layouts.template')

@section('title','login')
@section('description','ディスクリプション')
@section('page_style')
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
@stop
@include('head')
<!-- LOGIN FORM -->
<div class="text-center" style="padding:50px 0">
    <div class="logo">login</div>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="閉じる">
        <span aria-hidden="true">&times;</span>
      </button>
      demoユーザでログインする場合は
      <a href="javascript:void(0)" onclick="demoClick();">こちら</a>
    </div>
    <!-- Main Form -->
    <div class="login-form-1">
        <form id="login_form" class="text-left" method="POST" action="{{ route('login') }}">
        @csrf
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="lg_username" class="sr-only">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="lg_username" name="email" placeholder="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lg_password" class="sr-only">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="lg_password" name="password" placeholder="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- <div class="form-group login-group-checkbox">
                        <input type="checkbox" id="lg_remember" name="lg_remember">
                        <label for="lg_remember">remember</label>
                    </div> -->
                </div>
                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
            </div>
            <div class="etc-login-form">
                <p>forgot your password? <a href="/password/reset">click here</a></p>
                <p>new user? <a href="/register">create new account</a></p>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
</div>
@include('script')
<script>
function demoClick(){
    document.forms.login_form.lg_username.value = "demo@demo.jp";
    document.forms.login_form.lg_password.value = "password";
    $('.alert').alert('close');
}
</script>