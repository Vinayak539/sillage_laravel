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
            action="/myaccount/register"
            method="POST"
            autocomplete="off"
            class="register"
        >
            <div class="row">
                <div class="col-12">
                    <div class="input-group">
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value=""
                            required
                        />
                        <label>Name *</label>
                    </div>
                    <!-- /.input-group -->
                </div>
                <!-- /.col- -->
                <div class="col-12">
                    <div class="input-group">
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
                    <!-- /.input-group -->
                </div>
                <!-- /.col- -->
                <div class="col-12">
                    <div class="input-group">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                        />
                        <label>Email *</label>
                    </div>
                    <!-- /.input-group -->
                </div>
                <!-- /.col- -->
                <div class="col-12">
                    <div class="input-group">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            value=""
                            required
                        />
                        <label>Password *</label>
                    </div>
                    <!-- /.input-group -->
                </div>
                <!-- /.col- -->
            </div>
            <!-- /.row -->

            <button
                type="submit"
                class="line-button-one button-rose button_update_register"
            >
                Register
            </button>
        </form>

        <p class="or-text"><span>or</span></p>
        <ul class="social-icon-wrapper row">
            <li class="col-12">
                <a href="#" class="gmail"
                    ><i class="fa fa-envelope-o" aria-hidden="true"></i>
                    Gmail</a
                >
            </li>
        </ul>
    </div>
    <!-- /.sign-up-form-wrapper -->
</div>
<!-- /.signUp-page -->

@endsection @section('extrajs')
<script>
    $(document).ready(function () {
        $('.register').submit(function () {
            $('.button_update_register').attr('disabled', 'disabled');
            $('.button_update_register').html('Please Wait');
        });
    });

</script>
@endsection
