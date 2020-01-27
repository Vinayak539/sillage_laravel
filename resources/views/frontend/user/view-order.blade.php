@extends('layouts.master') @section('title','Orders') @section('content')

{{-- Model --}}

<div class="modal fade" id="orderReturn">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Return Order</h4>
                <button type="button" class="close cclose" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" role="form" class="form" action="{{ route('user.orders.return', $order->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="reason">Select Reason <span class="text-danger">*</span></label>
                                    <select name="reason" id="reason" class="form-control" required>
                                        <option value="">--Select Reason--</option>
                                        <option value="Within 7 Days"
                                            {{ old('reason') == 'Within 7 Days' ? 'selected' : '' }}>Within 7 Days
                                        </option>
                                        <option value="Wrong Products"
                                            {{ old('reason') == 'Wrong Products' ? 'selected' : '' }}>Wrong Products
                                        </option>
                                        <option value="Faulty Products"
                                            {{ old('reason') == 'Faulty Products' ? 'selected' : '' }}>Faulty Products
                                        </option>
                                        <option value="Quality Products"
                                            {{ old('reason') == 'Quality Products' ? 'selected' : '' }}>Quality Products
                                        </option>
                                        <option value="other" {{ old('reason') == 'other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 other_reason">
                                <div class="form-group">
                                    <label for="other_reason">Write Reason <span class="text-danger">*</span></label>
                                    <textarea name="other_reason" id="other_reason" class="form-control"
                                        rows="5">{{ old('other_reason') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image_url">Upload Product Image</label>
                                    <input type="file" name="image_url" id="image_url" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12 text-danger">
                                Note : All * Mark Fields are Compulsory !
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary button_update">
                            <i class="fa fa-plus"></i> Submit
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- Model End --}}

{{-- Help Model --}}

<div class="modal fade" id="orderHelp">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Need Help ? </h4>
                <button type="button" class="close cclose" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" role="form" class="form" action="{{ route('user.orders.help', $order->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" style="padding-left: 0">Write your query <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" class="form-control" rows="5"
                                        required>{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12 text-danger">
                                Note : All * Mark Fields are Compulsory !
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary button_update">
                            <i class="fa fa-plus"></i> Submit
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- Help Model End --}}
<!-- Breadcrumb area Start -->
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Order id: {{ $order->id }}</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('user.showOrder') }}">Orders</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<div id="content" class="main-content-wrapper order-details">
    <div class="page-content-inner">
        <div class="container">
            <div class="personal-detail">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('user.showOrder') }}" class="pull-left mt-0 mb-3"> <i
                                class="fa fa-angle-double-left" aria-hidden="true"></i> Go Back</a>
                    </div>
                    <div class="col-md-9">
                        <div class="address">
                            <h4>Delivery Address</h4>
                            <h5><strong>{{ $order->user->name }}</strong></h5>
                            <p>{{ $order->address }}</p>
                            @if($order->landmark)
                            <p>Landmark - {{ $order->landmark }}</p>
                            @endif
                            <p>City - {{ $order->city }}</p>
                            <p>Territory - {{ $order->territory }}</p>
                            <p>Pincode - {{ $order->pincode }}</p>
                            <p><strong>Phone Number - {{ $order->user->mobile }}</strong></p>
                            <p><strong>Email Id - {{ $order->user->email }}</strong></p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="review-sec float-right">
                            <h4><strong>More actions</strong></h4>
                            <a href="{{ route('user.invoices.download', $order->id) }}" class="download-invoice"
                                onclick="downloadInvoice()"><i class="fa fa-download" aria-hidden="true"></i>
                                Download</a>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#orderHelp"><i
                                    class="fa fa-question-circle" aria-hidden="true"></i>
                                Need Help</a>
                            <a href="" data-toggle="modal" data-target="#review"><i class="fa fa-star"
                                aria-hidden="true"></i>
                            Rate & Review</a>
                            @if($order->return_status === null && $order->status != 'Delivered')
                                @if($order->status != 'Shipped')
                                <a href="javascript:void(0);" class="cancelBtn" data-obj-id="{{ $order->id }}">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    Cancel
                                </a>
                                @else
                                <a href="javascript:void(0);" class="cancelBtn" data-obj-id="{{ $order->id }}">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    Cancel
                                </a>
                                <p>
                                    <strong class="text-danger">Note : Extra Shipping Charges will be charged.</strong>
                                </p>
                                @endif
                            @endif


                            @if($order->return_status === null && $order->status === 'Delivered')
                            <a href="javascript:void(0);" class="returnBtn" data-toggle="modal"
                                data-target="#orderReturn"><i class="fa fa-refresh" aria-hidden="true"></i>
                                Return</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-bordered mt--30 mb--30">
                <div class="row">
                    <div class="col-md-12">
                        <div class="order_sec">
                            @php $total = 0; @endphp
                            @foreach($order->details as $detail)
                            @php 
                                $total += $detail->quantity*$detail->mrp;
                                $offers = json_decode($detail->offers);
                                $exp_offers = explode(",", $offers);
                            @endphp
                            <div class="row mb-3">
                                <div class="col-sm-5">
                                    <div class="pro_sec">
                                        <div class="img">
                                            <img data-original="{!! asset('/storage/images/products/' . $detail->product->image_url) !!}"
                                                alt="{{ $detail->product->title }}" class="lazy">
                                        </div>
                                        <div class="content">
                                            <p class="title"><a href="/product/{{ $detail->product->slug_url }}">{{ $detail->product->title }}</a></p>
                                            <p>
                                                {{ $detail->size ? 'Size: ' . $detail->size->title : '' }} <br>
                                                {{ $detail->color ? 'Colour: ' . $detail->color->title : '' }} <br>
                                            </p>
                                            <p>Price : {{ $detail->mrp }}</p>
                                            <p>Qty : {{ $detail->quantity }}</p>
                                            <p>
                                                @if(!empty($exp_offers))
                                                    @foreach($exp_offers as $ofr)
                                                        @php
                                                            $offer = \App\Model\MapMstOfferProduct::where('id', $ofr)->with('product', 'color', 'size')->first();
                                                        @endphp

                                                        + {{ $offer->product->title }} [{{ $offer->size->title }} ML] <br />
                                                    @endforeach
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <p class="price">&#8377; {{ $detail->mrp*$detail->quantity }}</p>
                                </div>
                                <div class="col-sm-5">
                                    @if($order->delivery_date)
                                    <p class="delivery">Delivered by
                                        {{ date('M, d', strtotime($order->delivery_date)) }}</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-sm-12 mb-15">
                                            <p class="mb-0"><strong>Order On </strong></p>
                                            <p>{{ date('D, M d, Y' , strtotime($order->created_at)) }}</strong></p>
                                        </div>
                                        <div class="col-sm-12 mb-15">
                                            <p class="mb-0"><strong>Order Status </strong></p>
                                            <p class="text-capitalize">{{ $order->status }}</p>
                                        </div>

                                        @if($order->transaction)
                                        <div class="col-sm-12 mb-15">
                                            <p class="mb-0"><strong>Transaction ID </strong></p>
                                            <p>{{ $order->transaction->TXNID }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-sm-12 mb-15">
                                            <p class="mb-0"><strong>Payment Status </strong></p>
                                            <p> {{ $order->payment_status }}</p>
                                        </div>
                                        <div class="col-sm-12 mb-15">
                                            <p class="mb-0"><strong>Payment Mode </strong></p>
                                            <p class="text-capitalize"> {{ $order->payment_mode }}</p>
                                        </div>

                                        @if($order->status === 'delivered' && $order->delivery_date)
                                        <div class="col-sm-12 mb-15">
                                            <p class="mb-0"><strong>Delivered At </strong></p>
                                            <p> {{ date('d-M-Y h:i A', strtotime($order->delivery_date )) }} </p>
                                        </div>
                                        @endif
                                        @if($order->return_status !== null)
                                        <div class="col-sm-12 mb-15">
                                            <p class="mb-0"><strong>Return Status </strong></p>
                                            <p> {{ $order->return_status }} </p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-striped table-bordered table-hover table-dark">
                                        <tbody>
                                            <tr>
                                                <th>Total</th>
                                                <td><strong>&#8377; {{ $order->tbt }}</strong></td>
                                            </tr>
                                            <tr>
                                                <th> + CGST </th>
                                                <td> &#8377; {{ round($order->tax /2, 2) }} </td>
                                            </tr>
                                            <tr>
                                                <th> + SGST </th>
                                                <td> &#8377; {{ round($order->tax/2, 2) }} </td>
                                            </tr>
                                            @IF($order->discount)
                                            <tr>
                                                <th> - Discount </th>
                                                <td> &#8377; {{ $order->discount }} </td>
                                            </tr>
                                            @ENDIF
                                             <tr>
                                                <th> + Shipping Charges </th>
                                                <td> &#8377; {{ $order->total >= 1000 ? '0' : '60' }} </td>
                                            </tr>
                                            <tr>
                                                <th> <strong>Grand Total</strong> </th>
                                                <td> <strong>&#8377; {{ round($order->total, 2) }}</strong> </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Review Model Start --}}

<div class="modal fade" id="review">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Rating & Review</h4>
                <button type="button" class="close cclose" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="login">
                    <div class="login_form_container">
                        <div class="account_login_form">
                            <form class="form" method="POST" action="/myaccount/review">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label style="padding-left: 0">Select Product <span class="text-danger">*</span></label style="padding-left: 0">
                                        <select name="product_id" id="product_id" class="form__input form__input--2">
                                            <option value="">--Select Product--</option>
                                            @foreach($order->details as $order)
                                            <option value="{{ $order->product->id }}">
                                                {{ $order->product->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label style="padding-left: 0">Rating <span class="text-danger">*</span></label style="padding-left: 0">
                                        <div class="starability-grow">
                                            <input type="radio" id="growing-rate1" class="star" name="rating" checked
                                                value="1" {{old('rating')== 1 ? 'checked' : ''}}>
                                            <label for="growing-rate1" title="Terrible">1
                                                star</label>

                                            <input type="radio" id="growing-rate2" class="star" name="rating" value="2"
                                                {{old('rating')== 2 ? 'checked' : ''}}>
                                            <label for="growing-rate2" title="Not good">2
                                                stars</label>

                                            <input type="radio" id="growing-rate3" class="star" name="rating" value="3"
                                                {{old('rating')== 3 ? 'checked' : ''}}>
                                            <label for="growing-rate3" title="Average">3
                                                stars</label>

                                            <input type="radio" id="growing-rate4" class="star" name="rating" value="4"
                                                {{old('rating')== 4 ? 'checked' : ''}}>
                                            <label for="growing-rate4" title="Very good">4
                                                stars</label>

                                            <input type="radio" id="growing-rate5" class="star" name="rating" value="5"
                                                {{old('rating')== 5 ? 'checked' : ''}}>
                                            <label for="growing-rate5" title="Amazing">5
                                                stars</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label style="padding-left: 0">Comment <span class="text-danger">*</span></label>
                                        <textarea class="form__input form__input--textarea" name="comment" id="comment" cols="30" rows="4"
                                            placeholder="Write your comments here"
                                            required>{{ old('comment') }}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-4 text-center">
                                        <div class="save_button primary_btn default_button">
                                            <button type="submit" class="button_update">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Review Model End --}}

<form id="formCancel" method="POST" action="{{ route('user.orders.cancel') }}">
    @csrf
</form>

@endsection
@section('extracss')
<style>
    .table thead th,
    .table th,
    .table thead td,
    .table td {
        padding: 10px;
    }

    .order-details p {
        color: #000;
    }

    .order-details .personal-detail {
        box-shadow: 0px 2px 6px 2px #ccc;
        padding: 20px;
    }

    .order-details .address p {
        margin-bottom: 0px;
    }

    .order-details .address h4 {
        font-size: 18px;
        font-weight: 600;
    }

    .icon-circle {
        background: #ffd54c;
        text-align: center;
        height: 20px;
        width: 20px;
        line-height: 20px;
        border-radius: 50%;
        margin-right: 5px;
    }

    .order_sec {
        border: none;
        border-radius: 5px;
    }

    .order_sec .pro_sec .img,
    .order_sec p.delivery,
    .order_sec p.date,
    .padding10,
    .order_sec p.price {
        padding-left: 0;
    }

    .review-sec {
        padding-right: 0;
        padding-left: 0;
    }

    .review-sec a {
        display: block;
        border: 1px solid #333 !important;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        color: #333 !important;
    }

    .review-sec h4 {
        font-size: 18px;
        font-weight: 600;
    }

    @media screen and (max-width: 767px) {
        .order_sec .pro_sec {
            height: auto;
        }

        .order_sec .pro_sec .content {
            padding-top: 0;
            padding-top: 0;
        }

        .order_sec .pro_sec .content p.title {
            margin-bottom: 5px;
        }

        .order_sec .pro_sec .img,
        .order_sec p.delivery,
        .order_sec p.date,
        .padding10,
        .order_sec p.price {
            padding: 0;
        }

        .review-sec {
            float: unset !important;
        }
    }
</style>
@endsection
@section('extrajs')

<script>
    $(document).ready(function () {
        var val = '';
        reason(val);
        $('#reason').change(function () {
            var val = $(this).val();
            reason(val);
        });

        $('.cancelBtn').click(function () {

            if (window.confirm('Are you sure want to cancel order ?')) {
                var action = $("#formCancel").attr("action") + $(this).attr("data-obj-id");
                $("#formCancel").attr("action", action);
                $("#formCancel").submit();
                $(this).html('wait...');
            }
        });
    });

    function downloadInvoice() {
        $('.download-invoice').html(
            '<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span>');
        setTimeout(function () {
            $('.download-invoice').html('<i class="fa fa-download" aria-hidden="true"></i> Download');

        }, 2000);
    }

    function reason(val) {

        if (val == 'other') {
            $('.other_reason').show();
            $('#other_reason').attr('required', 'required');
        } else {
            $('.other_reason').hide();
            $('#other_reason').removeAttr('required', 'required');
        }
    }

</script>
@endsection
