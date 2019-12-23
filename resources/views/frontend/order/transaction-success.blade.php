@extends('layouts.master')
@section('title','Transaction Success')
@section('content')

<div class="element-section">
    <div class="breadcrumbs-bg-image theme-breadcrumbs" style="background-image: url(/assets/images/bg/common-bg.jpg);">
        <div class="container">
            <div class="d-md-flex align-items-center justify-content-between">
                <h2 class="page-title">Transaction Success</h2>
                <ul class="page-breadcrumbs">
                    <li><a href="/">Home</a></li>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                    <li>Transaction Success</li>
                </ul>
            </div>
        </div> <!-- /.container -->
    </div> <!-- /.breadcrumbs-bg-image -->
</div>

<section class="checkout-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-10">
                <div class="pull-right btn-box">
                    <button type="submit" class="btn-print" onclick="javascript:window.print();">
                        <i class="fa fa-print"></i>
                        Print
                    </button>
                </div>
            </div>
            @if(isset($order))
            <div class="col-md-12 div-visible">
                <div class="pb-10">
                    <h5 class="text-success">Your Order has been placed Successfully !</h5>
                </div>
                <div class="table-responsive">

                    <table border="1" class="table table-bordered ">
                        <tr>
                            <th colspan="2" class="text-center text-uppercase bg-silver">
                                Order Information
                            </th>
                        </tr>
                        <tr>
                            <td>
                                Order ID :
                                <mark class="lead">{{$order->id}}</mark>
                            </td>
                            @if($TXNID)
                            <td>
                                Transaction ID :
                                <mark class="lead">{{$TXNID}}</mark>
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <td colspan="2">
                                Payment Status :
                                <mark class="lead">{{ $order->payment_mode == 'cod' ? 'Cash On Delivery' : 'Paid' }}</mark>
                            </td>
                        </tr>
                    </table>
                    <table border="1" class="table table-bordered">
                        <tr>
                            <th colspan="12" class="text-center text-uppercase bg-silver">
                                Order Information
                            </th>
                        </tr>

                        <tr>
                            <th>Product Name</th>
                            <th>Volume</th>
                            <th>MRP (&#8377;)</th>
                            <th>QTY</th>
                            <th>AMOUNT (&#8377;)</th>
                        </tr>
                        @php $total = 0; @endphp
                        @foreach($order->details as $product)
                        @php $total += $product->quantity*$product->mrp; @endphp
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->volume }} mL</td>
                            <td>{{ $product->mrp != Null ? $product->mrp : 'Free'  }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->quantity * $product->mrp }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="12" class="bg-silver text-right text-uppercase">
                                <p>Total Amount : &#8377; {{ $order->tbt }}</p>
                                <p>CGST(9%) : &#8377; {{ round($order->tax / 2, 2)  }}</p>
                                <p>SGST(9%) : &#8377; {{ round($order->tax / 2, 2)  }}</p>
                                <p>Shipping Amt : &#8377; {{ $total >= 400 ? '0' : '50'  }}</p>
                                @if($order->discount) <p>Discount : &#8377; {{ $order->discount }}</p>@endif
                                <p>Grand Total : &#8377; {{ $order->total }}</p>
                            </th>
                        </tr>

                    </table>
                </div>
            </div>

            @endif
        </div>
    </div>
</section>
@endsection
@section('extracss')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        /* .button-visibility {
            display: none;
        } */
        /* nav.navbar.bootsnav .navbar-header {
            display: none;
        }
        footer.dark-bg {
            display: none;
        }*/
        .div-visible * {
            visibility: visible;
        }
        .div-visible {
            position: absolute;
            top: 0;
        }
        table.table tr td,
        table.table.table-lg tr th {
            padding: 5px 0 5px 5px;
        }
        .table>tbody>tr>th,
        .table>tfoot>tr>th {
            padding: 5px 0 5px 30px;
            font-weight: 100;
        }
    }
    .btn-print {
        background: #ed2024;
        width: 100px;
        color: #fff;
        border: 1px solid #ed2024;
        border-radius: 25px;
        padding: 5px 15px;
        margin: 0 0 10px 0;
    }
</style>
@endsection
