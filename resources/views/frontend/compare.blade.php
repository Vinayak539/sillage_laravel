@extends('layouts.master')
@section('title','Compare Products')
@section('content')

   <!-- Breadcrumb area Start -->
   <div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Compare</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li class="current"><span>Compare</span></li>
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
                    <div class="row ptb--80 ptb-md--60 ptb-sm--40">
                        <div class="col-12" id="main-content">
                            <div class="table-content table-responsive">
                                <div class="table-content table-responsive">
                                    <table class="table compare-table">
                                        <tbody>
                                            <tr>
                                                <th>Product Info</th>
                                                <td>
                                                    <div class="remove">
                                                        <a href="#">
                                                            <i class="fa fa-times"></i>Remove
                                                        </a>
                                                    </div>
                                                    <a href="product-details.html" class="d-block">
                                                        <div class="image-wrap">

                                                            <img src="{!! asset('assets/img/products/prod-18-1-120x138.jpg') !!} "
                                                                alt="Product">
                                                        </div>
                                                        <h4 class="product-name">Waxed-effect pleated skirt</h4>
                                                    </a>
                                                    <a href="{{ route('cart') }}" class="btn btn-tiny btn-style-1">Add to cart</a>
                                                </td>
                                                <td>
                                                    <div class="remove">
                                                        <a href="#">
                                                            <i class="fa fa-times"></i>Remove
                                                        </a>
                                                    </div>
                                                    <a href="product-details.html" class="d-block">
                                                        <div class="image-wrap">
                                                            <img src="{!! asset('assets/img/products/prod-13-1-120x138.jpg') !!} "
                                                                alt="Product">
                                                        </div>
                                                        <h4 class="product-name">Super skinny trousers</h4>
                                                    </a>
                                                    <a href="{{ route('cart') }}" class="btn btn-tiny btn-style-1">Add to cart</a>
                                                </td>
                                                <td>
                                                    <div class="remove">
                                                        <a href="#">
                                                            <i class="fa fa-times"></i>Remove
                                                        </a>
                                                    </div>
                                                    <a href="#" class="d-block">
                                                        <div class="image-wrap">

                                                            <img src="{!! asset('assets/img/products/prod-14-1-120x138.jpg') !!} "
                                                                alt="Product">
                                                        </div>
                                                        <h4 class="product-name">Super skinny blazer</h4>
                                                    </a>
                                                    <a href="{{ route('cart') }}" class="btn btn-tiny btn-style-1">Add to cart</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Price</th>
                                                <td>
                                                    <span class="product-price-wrapper">
                                                        <span class="money">₹159.00</span>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="product-price-wrapper">
                                                        <span class="money">₹159.00</span>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="product-price-wrapper">
                                                        <span class="money">₹159.00</span>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Sku</th>
                                                <td>REF. LA-887</td>
                                                <td>REF. LA-887</td>
                                                <td>REF. LA-887</td>
                                            </tr>
                                            <tr>
                                                <th>Description</th>
                                                <td class="text-center">Donec accumsan auctor iaculis. Sed suscipit arcu
                                                    ligula, at egestas… </td>
                                                <td class="text-center">Donec accumsan auctor iaculis. Sed suscipit arcu
                                                    ligula, at egestas… </td>
                                                <td class="text-center">Donec accumsan auctor iaculis. Sed suscipit arcu
                                                    ligula, at egestas… </td>
                                            </tr>
                                            <tr>
                                                <th>Availability</th>
                                                <td>In stock</td>
                                                <td>In stock</td>
                                                <td>In stock</td>
                                            </tr>
                                            <tr>
                                                <th>Weight</th>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                            </tr>
                                            <tr>
                                                <th>Dimensions</th>
                                                <td>N/A</td>
                                                <td>N/A</td>
                                                <td>N/A</td>
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
        <!-- Main Content Wrapper Start -->


@endsection
