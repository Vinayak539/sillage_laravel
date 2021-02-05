<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .wrapper {
            max-width: 500px;
            margin: auto;
        }

        img {
            height: 70px;

        }

        * {
            font-family: 'Segoe UI';
            color: #504E4E;
        }

        th {
            font-weight: 600;
            text-align: left;
        }

        .bg-silver {
            background-color: #eee;
        }

        h4 {
            font-family: inherit;
            font-weight: 500;
            line-height: 1.1;
            color: inherit;
            margin: 5px;
        }

        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }



        .row:after {
            clear: both;
        }


        .row {
            margin-right: -15px;
            margin-left: -15px;
        }

        .row:after,
        .row:before {
            display: table;
            content: " ";
        }



        .bg-silver {
            background-color: #eee !important;
            padding: 3px;
        }

        .col-sm-12 {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }


        .col-sm-12 {
            float: left;
        }

        .col-sm-12 {
            width: 100%;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #3c763d !important;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-danger {
            color: #fff !important;
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .alert-danger h3 {
            color: #fff !important;
        }

        .heading h3 {
            font-weight: 600 !important;
            font-family: inherit;
            line-height: 8px;
            color: #777;
            font-size: 16px;
        }

        .heading h3 span {
            color: #dc3545;
            font-weight: 600 !important;
            font-size: 20px !important;
        }

        .heading h3,
        .heading p {
            margin-bottom: 20px;
        }

        p {
            line-height: 1.8;
            font-size: 16px !important;
        }

        @media (min-width:768px) {
            .container {
                width: 500px
            }
        }

        @media (min-width:992px) {
            .container {
                width: 500px
            }
        }

        @media (min-width:1200px) {
            .container {
                width: 500px
            }
        }

        .btn {
            color: #fff !important;
            text-decoration: none;
            background: #dc3545;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .mb-40 {
            margin-bottom: 30px !important;
        }

        .text-center {
            text-align: center;
        }

    </style>

</head>

<body>
    <hr>
    <div class="container">
        <div>
            <a href="{{ url('/') }}" title="SILLAGE">
                <img src="{{ url('/') }}/assets/img/logo/logo.png" alt="SILLAGE" />
            </a>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <hr>
                <div class="heading">
                    <h2>Hello! SILLAGE Team</h2>
                    <p>
                        You are receiving this email because we received a password reset request for your account.
                    </p>



                    <div class="text-center mb-40">
                        <a href="{{url(config('app.url').route('password.reset', $token, false))}}" class="btn" title="Reset Password">Reset Password</a>
                    </div>

                    <p>If you did not request a password reset, no further action is required.</p>
                    <h3>Regards,</h3>
                    <h3>SILLAGE Teams</h3>
                </div>
                <hr>
                <p>
                    If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into
                    your web browser : <br> <a href="{{url(config('app.url').route('password.reset', $token, false))}}"
                        style="word-break: break-all;color: #3869d4;">{{url(config('app.url').route('password.reset',
                        $token, false))}}</a></p>
            </div>
        </div>
    </div>
</body>

</html>
