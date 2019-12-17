@extends('layouts.master') @section('title','Orders') @section('content')

<!-- Breadcrumb area Start -->
<div
    class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40"
>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Orders [{{ $order->id }}]</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="{{ route('user.showOrder') }}">Orders</a></li>
                    <li class="current"><span>{{ $order->id }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<div id="content" class="main-content-wrapper">
    <div class="page-content-inner">
        <div class="container">
            <div class="personal-detail">
                <div class="row">
                    <div class="col-md-5">
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
                    <div class="col-md-4">
                        <div class="coins">
                            <h4>Your Ranayas Coins</h4>
                            <h5>
                                <strong>
                                    {!! $order->reward_points ? '<i class="fa fa-bolt icon-circle"
                                        aria-hidden="true"></i> '.($order->reward_points / 2) . ' SuperCoin' : 'Product
                                    Yet to Delivered' !!}
                                </strong>
                            </h5>
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
                            @if($order->return_status === null && $order->status != 'delivered' && $order->status !=
                            'Order Cancel By Buyer')
                            @if($order->status != 'shipped')
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


                            @if($order->return_status === null && $order->status === 'delivered' && $order->status !==
                            'Order Cancel By Buyer')
                            <a href="javascript:void(0);" class="returnBtn" data-toggle="modal"
                                data-target="#orderReturn"><i class="fa fa-refresh" aria-hidden="true"></i>
                                Return</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-bordered mt-30 mb-30">
                <div class="row">
                    <div class="col-md-12">
                        <div class="order_sec">
                            @php $total = 0; @endphp
                            @foreach($order->details as $detail)
                            @php $total += $detail->quantity*$detail->mrp; @endphp
                            <div class="row mb-3">
                                <div class="col-sm-5">
                                    <div class="pro_sec">
                                        <div class="img">
                                            <img src="/storage/images/products/{{ $detail->product->image_url }}"
                                                alt="{{ $detail->product->title }}">
                                        </div>
                                        <div class="content">
                                            <p class="title">{{ $detail->product->title }}</p>
                                            <p>Price : {{ $detail->mrp }}</p>
                                            <p>Qty : {{ $detail->quantity }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <p class="price">&#8377; {{ $detail->mrp }}</p>
                                </div>
                                <div class="col-sm-5">
                                    @if($order->delivery_date)
                                    <p class="delivery">Delivered by
                                        {{ date('M, d', strtotime($order->delivery_date)) }}</p>
                                    @endif
                                    <p class="padding10">Return policy valid till
                                        {{ date('M, d', strtotime('+7 days', strtotime(str_replace('/', '-', \Carbon\Carbon::now())))) }}
                                    </p>
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
                                            <p> {{ $order->payment_mode }}</p>
                                        </div>
                                        @if($order->used_royalty_points)
                                        <div class="col-sm-12 mb-15">
                                            <p class="mb-0"><strong>Used Ranayas Coins </strong></p>
                                            <p> {{ $order->used_royalty_points}} </p>
                                        </div>
                                        @endif
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
                                            <tr>
                                                <th> - Discount </th>
                                                <td> &#8377; {{ $order->discount }} </td>
                                            </tr>
                                            @if($order->used_royalty_points)
                                            <tr>
                                                <th> - Ranayas Coins </th>
                                                <td> &#8377; {{ $order->used_royalty_points }} </td>
                                            </tr>
                                            @endif
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

@endsection
