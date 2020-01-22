<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>ADMINISTRATIVE LOGIN || HNI LIFESTYLE</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{!! asset('admin/css/app.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/bundles/bootstrap-social/bootstrap-social.css') !!}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{!! asset('admin/css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('admin/css/components.css') !!}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{!! asset('admin/css/custom.css') !!}">
    <link rel='shortcut icon' type='image/x-icon' href="{!! asset('admin/img/favicon.ico') !!}" />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Administrative Login</h4>
                            </div>
                            <div class="card-body">
                                <form class="md-float-material form-material needs-validation" id="formLogin"
                                    method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="password" class="control-label">Email</label>
                                        <input id="email" type="email"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') }}" placeholder="Your Email Address"
                                            required tabindex="1" autofocus>
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <!-- @if (Route::has('password.request'))
                                            <div class="float-right">
                                                <a href="{{ route('password.request') }}" class="text-small"
                                                    id="password">
                                                    Forgot Password?
                                                </a>
                                            </div>
                                            @endif -->
                                        </div>
                                        <input id="password" type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" placeholder="Password" tabindex="2" required>
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }} checked>
                                            <label class="custom-control-label" for="remember">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block btnSubmit"
                                            tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                                <div class="mt-5 text-muted text-left">
                                    <a href="{{ route('index') }}" target="_blank"><i class="fa fa-angle-double-left"
                                            aria-hidden="true"></i> Go to Website </a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Designed & Developed By <a href="https://www.sanjaresolutions.com" target="_blank">Sanjar E
                                Solutions</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- General JS Scripts -->
    <script src="{!! asset('admin/js/app.min.js') !!}"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="{!! asset('admin/js/scripts.js') !!}"></script>
    <!-- Custom JS File -->
    <script src="{!! asset('admin/js/custom.js') !!}"></script>
    <script src="{!! asset('admin/js/jquery.validate.min.js') !!}"></script>

    <script>
        $(document).ready(function () {

            jQuery.validator.addMethod("validate_email", function (value, element) {

                if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
                    return true;
                } else {
                    return false;
                }
            }, "Please enter a valid Email.");

            $("#formLogin").validate({
                rules: {

                    email: {
                        required: true,
                        validate_email: true,
                        remote: "{{ route('check.email') }}"
                    },

                    password: {
                        required: true,
                    },
                },
                messages: {
                    email: {
                        required: "Please Enter Email ID",
                        email: "Please Enter Valid Email",
                        remote: "These credentials do not match our records."
                    },
                    password: {
                        required: "Please Enter Password"
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
</body>

</html>
