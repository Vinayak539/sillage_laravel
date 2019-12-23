@extends('layouts.master') @section('title','Login') @section('content')


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


<div class="signUp-page signUp-minimal">
    <div class="signin-form-wrapper">
        <div class="title-area text-center">
            <h3>Login with otp.</h3>
        </div> <!-- /.title-area -->
        <form id="login-form" action="{{ route('user.login.otp') }}" method="POST" autocomplete="off" class="login">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="input-group">
                        <input type="text" name="email" value="{{ old('email') }}" required>
                        <label>Email *</label>
                    </div> <!-- /.input-group -->
                </div> <!-- /.col- -->
            </div> <!-- /.row -->
            <div class="agreement-checkbox d-flex justify-content-end align-items-center">
                <a href="{{ route('user.password.request') }}">Forget Password?</a>
            </div>
            <button type="submit" class="line-button-one button-rose button_update_login">Login</button>
        </form>
        <p class="signUp-text text-center">Don’t have any account? <a href="/myaccount/register">Sign up</a> now. & <a
                href="{{ route('user.login') }}"> Login</a></p>
        <p class="or-text"><span>or</span></p>
        <ul class="social-icon-wrapper row">
            <li class="col-12"><a href="/auth/google" class="gmail"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                    Gmail</a></li>
            <!--<li class="col-6"><a href="/auth/facebook" class="facebook"><i class="fa fa-facebook"-->
            <!--            aria-hidden="true"></i> Facebook</a></li>-->
        </ul>
    </div> <!-- /.sign-up-form-wrapper -->
</div> <!-- /.signUp-page -->

@endsection @section('extrajs')
<script>
    $(document).ready(function () {
        $('.login').submit(function () {
            $('.button_update_login').attr('disabled', 'disabled');
            $('.button_update_login').html('Please Wait');
        });
    });

</script>
@endsection @section('extracss')

<style>
    .signUp-page {
        position: relative;
        min-height: 70vh;
        z-index: 5;
        padding-top: 50px;
        padding-bottom: 50px;
    }

</style>

@endsection
