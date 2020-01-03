<!DOCTYPE html>
<html lang="en">

<head>
    <style>
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
        .alert-danger h3{
            color: #fff !important;
        }
        .heading h3{
            color: #dc3545;
            font-weight: 400 !important;
        }
         .heading h3 span{
            color: #dc3545;
            font-weight: 600 !important;
            font-size: 20px !important;
        }
        @media (min-width:768px) {
            .container {
                width: 650px
            }
        }
        @media (min-width:992px) {
            .container {
                width: 870px
            }
        }
        @media (min-width:1200px) {
            .container {
                width: 970px
            }
        }
        a {
            color: #337ab7;
            text-decoration: none;
        }
    </style>

</head>

<body>
    <div class="container">
        <div>
            <a href="{{ url('/') }}" title="The Hatke Store">
                <img src="{{ url('/') }}/assets/img/logo/logo.png" alt="The Hatke Store" />
            </a>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-success">
                    <h4>
                        Hi {{ $user->name }}
                    </h4>
                </div>

                <hr>
                <div class="heading">
                    <h3>Your One Time Password(OTP) is : <span>{{ $user->otp }}</span><br> for more details please <a href="{{ url('/') }}/reach-us" title="The Hatke Store">Reach Us</a></h3>
                </div>

                <hr>

                <div>
                    <b>
                        NOTE :
                    </b>
                    This is an autogenerated mail. Please do not reply to this mail. If you have any queries then go to
                    <a href="{{ url('/') }}/reach-us" title="Contact Us">Reach Us</a> Or send a mail at
                    <a href="mailto:support@thehatkestore.com" title="support@thehatkestore.com">support@thehatkestore.com</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
