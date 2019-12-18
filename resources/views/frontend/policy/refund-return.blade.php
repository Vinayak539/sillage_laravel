@extends('layouts.master')
@section('title','Refund & Return')
@section('content')


<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Refund & Return</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li class="current"><span>Refund & Return</span></li>
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
                 
                        <h5>Perfumes & Room Fresheners are Not Returnable.</h5>
                        <p class="color--light-3">We have <span>“Happy Return Policy“</span> where you can return a product within 72hrs [ From Time of
                            Delivery ] and we also accept partial returns of one or more products in a order.</p>
                        <strong>Note : Returns not accepted under following Circumstances :</strong>
                        <ul>
                            <li>Product returned without original Packing including Price Tags, Labels, Freebies / Gifts
                                and other accessories.</li>
                            <li>Product used or seal is Tampered.</li>
                            <li>Barcode or security Code is Tampered with.</li>
                            <li>If request for return is initiated after 72 hrs from the time of Delivery.</li>
                            <li>Freebies / Gift is damaged or not returned with Products Ordered.</li>
                        </ul>
                        <strong>Incase of Damaged / Defective / Wrong Product in my Order</strong>
                        <p class="color--light-3">We follow 2 layer check before a product is packed and use right packaging to ensure customer
                            receive product in Perfect Condition. Even after taking all precautions if the product is
                            damaged during shipment or transit, you can request for a replacement or refund.
                        </p>
                        <p class="color--light-3">If you have received an item in a damaged/defective condition or have been sent a wrong
                            product, you can follow a few simple steps to initiate your return/refund within 3 days of
                            receiving the order:</p>
                        <ul>
                            <li><strong>Step 1:</strong> Contact our Customer Support team via email ( <a href="mailto:customersupport@hnilifestyle.com">customersupport@hnilifestyle.com</a> )
                                within 72 hrs from the time of receiving the order.</li>
                            <li><strong>Step 2:</strong> Kindly share your Invoice number and an image of the product.</li>
                            <li><strong>Step 3:</strong> We will pick up the products within 2- 4 business days. We will initiate the
                                refund or replacement process only if the products are received by us in their original
                                packaging with their seals, labels and barcodes intact.
                            </li>
                        </ul>
                        <p class="color--light-3">Note: Incase of replacement, it is subject to the availability of stock. If stock not
                            available we will refund you the full amount.</p>

                    </div>
                </div>
              
            </div>
        </div>
    </div>
</div>
<!-- Main Content Wrapper Start -->

@endsection
