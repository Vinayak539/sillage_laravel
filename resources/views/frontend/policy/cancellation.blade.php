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
                        <p class="color--light-3">Incase you change your mind and wish to cancel an order that has been
                            shipped or out for Delivery, email us at <a
                                href="mailto:support@sillageniche.com">support@sillageniche.com</a>.</p>
                        <strong>Request :</strong>
                        <p class="color--light-3"> If the order is out for delivery and courier boy attempts to deliver
                            kindly do not accept the delivery of the order.</p>
                        <p class="color--light-3">Once we receive the product back we will verify the packaging /
                            Conditions [ <span>SILLAGE NICHE</span> reserves the right to dishonor cancelation request
                            that are fraudulent or Intentional and decision taken by company management will be Final ].
                            After inspection we will return your balance money after deducting Shipping Charges and
                            Return Expenses within 10 to 15 days after cancellation request is duly processed by our
                            Team.
                        </p>
                        <strong>Before Shipment : </strong>
                        <p class="color--light-3">Incase you change your mind and wish to cancel an order that has not
                            been shipped, immediately email us at <a
                                href="mailto:support@sillageniche.com">support@sillageniche.com</a>.</p>
                        <p class="color--light-3">In such circumstances the order will be cancelled and the total money
                            paid by you will be returned to your account within 48 to 72 Business Hours after
                            cancellation request is duly processed by our Team.</p>
                        <strong>Incase of Loyalty Points or Discount Voucher used. </strong>
                        <ul class="theme-list-item">
                            <li><i class="fa fa-check" aria-hidden="true"></i> Discount Coupon are meant for Single use
                                and shall be treated as used.</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Loyalty Points redeemed will be credited
                                back to your account incase of Cancellation.
                            <li>
                        </ul>
                        <p class="mt-5"><strong>FAQ for Cancellation </strong></p>
                        <p><strong>1] What is your cancellation Policy ?</strong><br />
                            A] Same as above
                        </p>
                        <p></p>
                        <p><strong>2] Can I cancel the order ?</strong><br />
                            A] Yes. Cancellation is possible in both “After Shipment “ and “ Before Shipment “. For more
                            details kindly check Cancellation Policy.
                        </p>
                        <p><strong>3] Procedure to cancel Order ?</strong><br />
                            A] Kindly mail us on <a
                                href="mailto:support@sillageniche.com">support@sillageniche.com</a>
                            along with your order ID that you wish to cancel your order.
                        </p>
                        <p><strong>4] When will I get my money refunded post Cancellation of Order ?</strong><br />
                            A] Incase of “Before Shipment “We initiate the refund immediately upon cancellations. The
                            time for the refund to reflect in your source account might vary depending on method of
                            Payment and it will be refunded in 48 to 72 Business Hours.
                        </p>
                        <p>However incase of “After Shipment “ only after inspection we will return your balance money
                            after deducting Shipping Charges and Return Expenses within 10 to 15 Working Days after
                            cancellation request is duly processed by our Team.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Main Content Wrapper Start -->

@endsection
