@extends('layouts.master') @section('title','Login') @section('content')

<div class="signUp-page signUp-minimal pt--70">
    <div class="signin-form-wrapper">
        <div class="title-area text-center">
            <h3>Login with otp</h3>
        </div> <!-- /.title-area -->
        <form id="login-form" action="{{ route('user.login.otp') }}" method="POST" autocomplete="off" class="login">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="input-group">
                        <input type="number" name="mobile" value="{{ old('mobile') }}" min="0" required>
                        <label>Enter 10 digit Mobile Number *</label>
                    </div>
                    <div>
                        <label for="mobile" class="error"></label>
                    </div>
                    <!-- /.input-group -->
                </div> <!-- /.col- -->
            </div> <!-- /.row -->
            <div class="agreement-checkbox d-flex justify-content-end align-items-center">
                <a href="{{ route('user.password.request') }}">Forgot Password?</a>
            </div>
            <button type="submit" class="line-button-one button-rose btnSubmit" tabindex="1">Login</button>
        </form>
        <p class="signUp-text text-center">Don’t have any account? <a href="{{ route('user.register') }}">Sign up</a> now. & <a
                href="{{ route('user.login') }}"> Login</a></p>
        <p class="or-text"><span>or</span></p>
        <ul class="social-icon-wrapper row">
            <li class="col-12">
                <a href="{{ route('user.auth.socialite', 'google') }}" class="gmail"><i class="fa fa-envelope-o" aria-hidden="true"></i> Gmail</a>
            </li>
            <li class="col-12">
                <a href="{{ route('user.auth.socialite', 'facebook') }}" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i>
                    Facebook</a>
            </li>
        </ul>
    </div> <!-- /.sign-up-form-wrapper -->
</div> <!-- /.signUp-page -->

@endsection @section('extrajs')
<script>
    $(document).ready(function () {
       
        $("#login-form").validate({
            rules: {

                mobile: {
                    required: true,
                    number:true,
                    minlength: 10,
                    maxlength: 10,
                },

            },
            messages: {
                mobile: {
                    required: "Please Enter Mobile Number",
                    number: "Please Enter Valid Mobile Number",
                    minlength: "Mobile Number should be of 10 digits",
                    maxlength: "Mobile Number should be of 10 digits",
                },
              
            },
            submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });

    });

</script>
@endsection @section('extracss')

<style>
    .error {
        color: rgb(238, 53, 53);
    }

    .signUp-page {
        position: relative;
        min-height: 70vh;
        z-index: 5;
        padding-top: 50px;
        padding-bottom: 50px;
    }
</style>

@endsection