@extends('layouts.master') @section('title','Reset Password') @section('content')

<!-- Breadcrumb area Start -->
<div
    class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40"
>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Reset Password</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="current"><span>Reset Password</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<div class="signUp-page signUp-minimal">
    <div class="signin-form-wrapper">
        <div class="title-area text-center">
            <h3>Reset Password</h3>
        </div> <!-- /.title-area -->
        <form id="login-form" action="{{ route('user.reset.password') }}" method="POST" autocomplete="off" class="needs-validation">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="input-group mb-0">
                        <input type="text" name="email" id="email" value="{{ $email ?? old('email') }}" required autofocus>
                        <label>Email *</label>
                    </div> <!-- /.input-group -->
                    <label for="email" class="error"></label>
                </div> <!-- /.col- -->
               
                <div class="col-12">
                    <div class="input-group mb-0">
                        <input type="password" name="password" id="password" required>
                        <label>New Passwords *</label>
                    </div> <!-- /.input-group -->
                    <label for="password" class="error"></label>
                </div> <!-- /.col- -->

                <div class="col-12">
                    <div class="input-group mb-0">
                        <input type="password" name="con_password" id="con_password" required>
                        <label>Confirm Password *</label>
                    </div> <!-- /.input-group -->
                    <label for="con_password" class="error"></label>
                </div> <!-- /.col- -->

            </div> <!-- /.row -->
            <button type="submit" class="line-button-one button-rose btnSubmit">Update</button>
        </form>
    </div> <!-- /.sign-up-form-wrapper -->
</div>

@endsection
@section('extracss')
<style>
    .signUp-page {
        position: relative;
        min-height: 50vh;
        z-index: 5;
        padding-top: 50px;
        padding-bottom: 50px;
    }

</style>
@endsection
@section('extrajs')
<script>
    $(document).ready(function() {

        $("#login-form").validate({
            rules: {           

                email: {
                    required: true,
                    email:true,
                },
                
                con_password: {
                    required: true,
                    equalTo:"#password"
                },
                
                password: {
                    required:true
                }
               
            },
            messages: {
              
                email: {
                    required: "Please Enter Email"
                },

                password: {
                    required: "Please Enter Password"
                },

                con_password: {
                    required: "Please Enter Confirm Password",
                    equalTo: "Please Enter Confirm Password same as above password",
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
@endsection
