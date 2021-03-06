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

        .table {
            border-collapse: collapse !important;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }

        .table-responsive>.table {
            margin-bottom: 0;
        }

        .table tr td,
        .table tr th {
            padding: 5px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }

        .text-center {
            text-align: center;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd !important
        }

        .text-right {
            text-align: right;
        }

        .table-responsive {
            width: 100%;
            margin-bottom: 15px;
            overflow-y: hidden;
            -ms-overflow-style: -ms-autohiding-scrollbar;
            border: 1px solid #ddd;
            min-height: .01%;
            overflow-x: auto
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
        <div class="row">
            @foreach($coupons as $code)
            <div class="col-sm-2">
                <h4>
                {{ $code->dis_code }}        
                </h4>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>
