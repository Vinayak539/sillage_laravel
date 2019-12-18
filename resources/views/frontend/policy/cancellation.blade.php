@extends('layouts.master')
@section('title','Cancellation')
@section('content')

<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Cancellation</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li class="current"><span>Cancellation</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb area End -->

        
<!-- Main Content Wrapper Start -->
<div id="content" class="main-content-wrapper">
    <div class="page-content-inner">
        <div class="container">
            <div class="row ptb--40 ptb-md--30 ptb-sm--20">
                <div class="col-lg-12  col-md-12 order-md-2 mb-sm--25">
                    <div class="about-text">
                 
                        <strong>After Shipment :</strong>
                        <p class="color--light-3">Incase you change your mind and wish to cancel an order that has been shipped or out for Delivery, email us at <a href="mailto:support@hnilifestyle.com">support@hnilifestyle.com</a> or call us on <a href="tel:+919619614785">+91 961 9614 785 </a> (Timing 10:30AM To 6:30PM | Mon To Fri)</p>
                        <strong>Request :</strong>
                        <p class="color--light-3"> If the order is out for delivery and courier boy attempts to deliver kindly do not accept the delivery of the order.</p>
                        <p class="color--light-3">Once we receive the product back we will verify the packaging / Conditions [ <span>HNILifeStyle</span> reserves the right to dishonor cancelation request that are fraudulent or Intentional and decision taken by company management will be Final ]. After inspection we will return your balance money after deducting Shipping Charges, Return Expenses, Damage Charges [ If Any ] within 48 to 72 Business Hours after cancellation request is duly processed by our Team.
                        </p>
                        <strong>Before Shipment : </strong>
                        <p class="color--light-3">Incase you change your mind and wish to cancel an order that has not been shipped, immediately email us at <a href="mailto:support@hnilifestyle.com">support@hnilifestyle.com</a> or call us on <a href="tel:+919619614785">+91 961 9614 785 </a> (Timing 10:30AM To 6:30PM | Mon To Fri)</p>
                        <p class="color--light-3">    In such circumstances the order will be cancelled and the money will be returned to your account within 48 to 72 Business Hours after cancellation request is duly processed by our Team.</p>
                        <strong>Incase of Loyalty Points or Discount Voucher used. </strong>
                        <ul class="theme-list-item">
                            <li><i class="fa fa-check" aria-hidden="true"></i> Discount Coupon are meant for Single use and shall be treated as used.</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Loyalty Points redeemed will be credited back to your account incase of Cancellation.<li>
                        </ul>

                    </div>
                </div>
              
            </div>
        </div>
    </div>
</div>
<!-- Main Content Wrapper Start -->

@endsection
