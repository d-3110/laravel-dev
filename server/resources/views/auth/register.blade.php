@extends('layouts.template')

@section('title','register')
@section('description','ディスクリプション')
@include('head')
<div class="text-center" style="padding:50px 0">
    <div class="logo">register</div>
    <!-- Main Form -->
    <div class="login-form-1">
        <form method="POST" action="{{ route('register') }}" id="register-form" class="text-left">
            @csrf
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <!-- メールアドレス -->
                    <div class="form-group">
                        <label for="reg_email" class="sr-only">{{ __('E-Mail Address') }}</label>
                        <input id="reg_email" type="email" 
                               class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email">
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>
                    <!-- パスワード-->
                    <div class="form-group">
                        <label for="reg_password" class="sr-only">{{ __('Password') }}</label>
                        <input id="reg_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- 確認パスワード-->
                    <div class="form-group">
                        <label for="reg_password_confirm" class="sr-only">{{ __('Confirm Password') }}</label>

                        <input id="reg_password_confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="confirm password">
                    </div>
                    <!-- 部署 -->
                    <div class="form-group">
                        <label for="reg_deptId" class="sr-only">{{ __('Dept ID') }}</label>
                        <select class="form-control form-select" name="dept_id" id="reg_deptId" onchange="changeColor(this)">
                            <option value="" style="display: none;">dept</option>
                            <option value="1">ぶしょ1</option>
                            <option value="2">ぶしょ2</option>
                            <option value="3">ぶしょ3</option>
                            <option value="4">ぶしょ4</option>
                            <option value="5">ぶしょ5</option>
                        </select>
                    </div>
                    <!-- 職種 -->
                    <div class="form-group">
                        <label for="reg_jobId" class="sr-only">{{ __('Job ID') }}</label>
                        <select class="form-control form-select" name="job_id" id="reg_jobId" onchange="changeColor(this)">
                            <option value="" style="display: none;">job</option>
                            <option value="1">じょぶ1</option>
                            <option value="2">じょぶ2</option>
                            <option value="3">じょぶ3</option>
                            <option value="4">じょぶ4</option>
                            <option value="5">じょぶ5</option>
                            <option value="6">じょぶ6</option>
                            <option value="7">じょぶ7</option>
                            <option value="8">じょぶ8</option>
                        </select>
                    </div>
                    <!-- 権限 -->
                    <div class="form-group">
                        <div class="form-check form-check-inline form-radio">
                            <label for="reg_isAdmin" class="radio sr-only">
                              <input type="radio" data-toggle="radio" name="is_admin" value="0" data-radiocheck-toggle="radio" checked="" id="reg_isAdmin">
                              
                            </label>
                            General
                        </div>
                        <div class="form-check form-check-inline form-radio">
                            <label for="reg_isAdmin" class="radio sr-only">
                              <input type="radio" data-toggle="radio" name="is_admin" value="1" data-radiocheck-toggle="radio" disabled="">
                            </label>
                            Admin
                        </div>
                    </div>
                </div>
                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                <button type="submit" class="login-button btn btn-primary"><i class="fa fa-_628"></i></button>

            </div>
            <div class="etc-login-form">
                <p>already have an account? <a href="#">login here</a></p>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
</div>
<script>
// selectで選択されたら文字色を変える
function changeColor(obj){
    if( obj.value == 0 ){
        obj.style.color = '';
    }else{
        obj.style.color = '#555555';
    }
}
</script>




