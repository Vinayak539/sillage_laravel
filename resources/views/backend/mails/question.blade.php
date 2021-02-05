<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Enquiry</title>
    <style>
        * {
            font-family: 'Segoe UI';
            color: #504E4E;
        }

        th {
            text-align: center !important;
        }

        .bg-silver {
            background-color: #eee;
        }

        h3 {
            font-family: inherit;
            font-weight: 500;
            line-height: 1.1;
            color: inherit;
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
            padding: 15px;
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
    </style>
</head>

<body>

    <div class="container">
        <div>
            <h3>SILLAGE</h3>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-success">
                    <h3>
                        Hi, You have a new Question of {{ $product->title }} on {{ date('d-M-Y h:i A', strtotime($qna->created_at)) }} !
                    </h3>
                </div>
                <table class="table table-bordered table-responsive">
                    <tr>
                        <th colspan="2" class="text-center text-uppercase bg-silver">
                            Information
                        </th>
                    </tr>

                    <tr>
                        <td>
                            Product Name / ID:
                        </td>
                        <td>
                            {{ $product->title }} / {{ $product->id }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Question :
                        </td>
                        <td>
                            {{ $qna->question }}</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
