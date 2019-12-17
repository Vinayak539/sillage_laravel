<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        * {
            font-family: 'Segoe UI';
            color: #000;
            font-size: 11px;
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
            padding-left: 2px;
            margin: 0 auto;
            width: 350px !important;
        }

        .row:after {
            clear: both;
        }

        .clear_both {
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
            background-color: #000 !important;
            padding: 3px;
            color: #fff;
            font-weight: 700;
        }

        .col-sm-6 {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }


        .col-sm-6 {
            float: left;
        }

        .col-sm-6 {
            width: 100%;
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
            border-top: 1px solid #000;
        }

        .text-center {
            text-align: center;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #000 !important
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

        .invoice_span {
            float: right;
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
                width: 970px;
            }
        }

        a {
            color: #337ab7;
            text-decoration: none;
        }

        .company_title {
            font: 600 14px normal bold;
            text-transform: uppercase;
            margin-bottom: 5px !important;
        }

        .company_address {
            font-size: 9px !important;
            text-align: center;
            margin: 0 !important;
            padding: 0 !important;
        }

        .pb-20 {
            padding-bottom: 20px !important;
            /* height: 150px !important; */
        }

        .main-border {
            border: 1px solid #000;
            padding: 10px;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .text-white {
            color: #fff !important;
        }

        .fw-600{
            font-weight: 900;
        }

        .mt-10{
            margin-top: 10px;
        }

    </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 pb-20">
                <h3>To, </h3>
                {!! $label['to_label'] !!}
            </div>
            <div class="col-sm-12 mt-10">
                <h3>From,</h3>
                <h3>Ranayas Store</h3>
                {!! $label['from_label'] !!}
            </div>
        </div>
    </div>
</body>

</html>