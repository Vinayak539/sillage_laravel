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

                        <p class="color--light-3">
                            With our policy of ensuring customer satisfaction, this return and refund Policy of
                            www.hnilifestyle.com list procedures and policies in accepting Product returns, once a
                            Product has been delivered to a customer after purchase from our website. Any return of
                            Products by customer shall be governed by and subject to the terms and conditions set in
                            this Return and Refund Policy.
                        </p>

                        <p class="color--light-3">
                            We request customers to read and understand the terms of this Return and Refund Policy. If
                            you do not agree to the terms contained in this Return and Refund Policy and if you do not
                            to accept the Terms of Use and may forthwith leave and stop using the website. The terms
                            contained in this Return and Refund Policy shall be accepted without modification and you
                            agree to be bound by the terms contained herein by initiating a request for purchase of
                            Product on the website.
                        </p>

                        <h5>Terms of Return and Refund</h5>
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2"> Product Category</th>
                                        <th>Return Period</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="2"> Clothing </td>
                                        <td> Shirts, T – Shirts and Vests. </td>
                                        <td> 07 days from the date of delivery**.</td>
                                    </tr>
                                    <tr>
                                        <td> Boxers, Joggers, Half Pants etc.
                                            Innerwear: Briefs and Panties, lingerie sets and Socks
                                        </td>
                                        <td> Non-Returnable. </td>
                                    </tr>
                                    <tr>
                                        <td>Personal Care</td>
                                        <td>Perfumes, Skin care, Hair Care and any Cosmetic Products etc.</td>
                                        <td>Non-Returnable.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <strong>Note : *07 days counted from the day of delivery.</strong>
                        <strong>Note : *Returns not accepted under following CONDITONS :</strong>
                        <ul>
                            <li><i class="fa fa-check" aria-hidden="true"></i>  Product returned without original Packing including Price Tags, Labels, Freebies /
                                Gifts and other accessories.
                            </li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Product used, soiled or seal is Tampered.</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Barcode or security Code is tampered with.</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i>  If request for return is initiated after 07 days from the day of Delivery.</li>
                            <li><i class="fa fa-check" aria-hidden="true"></i> Freebies / Gift is damaged, used or not returned with Products Ordered.
                            </li>
                        </ul>
                        <strong>Refund Charges :
                        </strong>
                        <p class="color--light-3">
                            We deduct Shipping Charges in case of product Returned and balance amount will be refunded
                            in your account.
                        </p>
                        <strong>Incase of Damaged / Defective / Wrong Product in my Order </strong>
                        <p class="color--light-3">We follow 2 level check before a product is packed and use right
                            packaging to ensure customer receive product in Perfect Condition. Even after taking all
                            precautions if the product is damaged during shipment or transit, you can request for a
                            replacement or refund.</p>
                        <p class="color--light-3">If you have received an item in a damaged/defective condition or have
                            been sent a wrong product, you can follow a few simple steps to initiate your return/refund
                            within 72 Hrs of receiving the order:</p>
                        <ul>
                            <li><strong>Step 1:</strong> Contact our Customer Support team via email (<a
                                    href="mailto:customersupport@hnilifestyle.com">customersupport@hnilifestyle.com</a>)
                                within 72 hrs from the time of receiving the order.</a>) within 72 hrs from the time of
                                receiving the order.</li>
                            <li><strong>Step 2:</strong> Kindly share your Invoice number and an image of the product.
                            </li>
                            <li><strong>Step 3:</strong> We don’t have return Pick arrangement hence you need to pack
                                the product and send us to below mentioned address :
                            </li>
                        </ul>
                        <p class="color--light-3">
                            KHUSHI NATURALS,<br />
                            Unit No.112 / 1st Floor, Bldg No.A6, Harihar Complex,<br />
                            Dapode, Bhiwandi – 421302,<br />
                            Maharashtra.
                        </p>

                        <p class="color--light-3">We will initiate the refund or replacement process only if the
                            products are received by us in their original packaging with their seals, labels, barcodes
                            intact and freebies or gifts are returned along with Product. Khushi Naturals reserves the
                            right to dishonor return request that are fraudulent or intentional and decision taken by
                            Management will be final.</p>

                        <p class="color--light-3">
                            <strong>
                                Note: Incase stock not available of ordered product we will refund you the full amount
                                on receiving the product.
                            </strong>
                        </p>
                        
                        <p class="color--light-3">
                            <strong>1] How do I return my Product ?</strong>    <br />
                            A] Incase you wish to return your product kindly send us email on <a href="mailto:customersupport@hnilifestyle.com">customersupport@hnilifestyle.com</a>
    Along with your Order ID and reason for return.

                        </p>
                        <p class="color--light-3">
                            <strong>2] What if I don't like the product as soon as it is delivered? Can I return it to courier person?</strong><br />
                            A] No. we don’t have such arrangement of returns with our courier partner.
                        </p>
                        <p class="color--light-3">
                            <strong>3] Will I be refunded the shipping charges incase of return ?</strong><br />
                            A] No we deduct Shipping Charges from your paid amount.
                        </p>
                        <p class="color--light-3">
                            <strong>4] When is my refund on return processed?</strong><br />
                            A] Once we receive the product at our warehouse and necessary check done by our Team we refund your amount in 10 to 15 days. 
                        </p>
                        <p class="color--light-3">
                            <strong>5] I have still not received my refund Amount kindly help ?</strong><br />
                            A] We apologize for delay and request you to send a mail with subject : “Urgent Refund Pending” to <a href="mailto:customersupport@hnilifestyle.com">customersupport@hnilifestyle.com</a> with your Order Number and we shall do the needful.
                        </p>
                        <p class="color--light-3">
                            
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Main Content Wrapper Start -->

@endsection
@section('extracss')
<style>
    .table-bordered {
        border: 1px solid #dee2e6 !important;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6 !important;
    }

    .table td,
    .table th {
        padding: .75rem !important;
        vertical-align: top !important;
        border-top: 1px solid #dee2e6 !important;
    }

</style>
@endsection
