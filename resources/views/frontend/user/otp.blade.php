@extends('layouts.master')
@section('title','Login with OTP')
@section('content')


<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">OTP</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="current"><span>OTP</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<!-- /.signUp-page start -->
<div class="signUp-page signUp-minimal">
    <div class="signin-form-wrapper">
        <!-- <div class="title-area text-center">
            <h3>Login with otp.</h3>
        </div>  -->
        <form id="login-form" action="/myaccount/login/otp" method="POST" autocomplete="off" class="login">
            <input type="hidden" name="_token" value="VUd7GU3HstuDMKODoTdUH3JETKDiopD28amJOVgD">
            <div class="row">
                <div class="col-12">
                    <div class="input-group">
                        <input type="text" name="email" value="" required>
                        <label>Email *</label>
                    </div> <!-- /.input-group -->
                </div> <!-- /.col- -->
            </div> <!-- /.row -->
            <div class="agreement-checkbox d-flex justify-content-end align-items-center">
                <a href="{{ route('forget-password') }}">Forget Password?</a>
            </div>
            <button type="submit" class="line-button-one button-rose button_update_login">Login</button>
        </form>
        <p class="signUp-text text-center">Don’t have any account? <a href="{{ route('register') }}">Register</a> now. & <a
                href="{{ route('user.login') }}"> Login</a></p>
        <p class="or-text"><span>or</span></p>
        <ul class="social-icon-wrapper row">
            <li class="col-12"><a href="#" class="gmail"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                    Gmail</a></li>
           
        </ul>
    </div> <!-- /.sign-up-form-wrapper -->
</div> <!-- /.signUp-page -->

@endsection
