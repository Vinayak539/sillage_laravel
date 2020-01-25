@extends('layouts.master') @section('title','Register') @section('content')

<div
    class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40"
>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Register</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="current"><span>Register</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<div class="signUp-page signUp-minimal">
    <div class="signin-form-wrapper">
        <!-- <div class="title-area text-center">
            <h3>Sign Up.</h3>
        </div>  -->
        <form
            id="login-form"
            action="{{ route('user.register') }}"
            method="POST"
            autocomplete="off"
            class="register needs-validation"
        >
        @csrf
            <div class="row">
                <div class="col-12">
                    <div class="input-group mb-0">
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            required
                        />
                        <label>Name *</label>
                    </div>
                    <label for="name" class="error"></label>
                    <!-- /.input-group -->
                </div>
                <!-- /.col- -->
                <div class="col-12">
                    <div class="input-group mb-0">
                        <input
                            type="number"
                            name="mobile"
                            id="mobile"
                            value="{{ old('mobile') }}"
                            minlength="10"
                            maxlength="10"
                            min="0000000000"
                            required
                        />
                        <label>Mobile Number *</label>
                    </div>
                    <label for="mobile" class="error"></label>

                    <!-- /.input-group -->
                </div>
                <!-- /.col- -->
                <div class="col-12">
                    <div class="input-group mb-0">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                        />
                        <label>Email *</label>
                    </div>
                    <label for="email" class="error"></label>

                    <!-- /.input-group -->
                </div>
                <!-- /.col- -->
                <div class="col-12">
                    <div class="input-group mb-0">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            value="{{ old('password') }}"
                            required
                        />
                        <label>Password *</label>
                    </div>
                    <label for="password" class="error"></label>

                    <!-- /.input-group -->
                </div>
                <!-- /.col- -->
            </div>
            <!-- /.row -->

            <button
                type="submit"
                class="line-button-one button-rose btnSubmit"
            >
                Register
            </button>
        </form>

        <p class="or-text"><span>or</span></p>
        <ul class="social-icon-wrapper row">
            <li class="col-12">
                <a href="{{ route('user.auth.socialite', 'google') }}" class="gmail"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                    Gmail</a>
            </li>
            <li class="col-12">
                <a href="{{ route('user.auth.socialite', 'facebook') }}" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i>
                    Facebook</a>
            </li>
        </ul>
    </div>
    <!-- /.sign-up-form-wrapper -->
</div>
<!-- /.signUp-page -->

@endsection 

@section('extrajs')
<script>
    $(document).ready(function () {
       
        $("#login-form").validate({
            rules: {

                name: {
                    required: true,
                },             

                email: {
                    required: true,
                    email:true,
                },
                
                mobile: {
                    required: true,
                    number:true,
                    minlength: 10,
                    maxlength: 10
                },

                password: {
                    required:true
                }
               
            },
            messages: {
              
                name: {
                    required: "Please Enter Name"
                },

                email: {
                    required: "Please Enter Email"
                },

                password: {
                    required: "Please Enter Password"
                },

                mobile: {
                    required: "Please Enter Mobile Number",
                    number: "Mobile Number should be numeric only",
                    minlength: "Mobile Number should be 10 digits",
                    maxlength: "Mobile Number should be 10 digits",
                }

            },
            submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });
    });

</script>
@endsection
