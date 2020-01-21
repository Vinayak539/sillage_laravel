@extends('layouts.master')
@section('title') Products @endsection
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area pt--70 pt-md--25">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>

                    <li class="current"><span>Products</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<!-- Main Content Wrapper Start -->
<div id="content" class="main-content-wrapper">
    <div class="shop-page-wrapper">
        <div class="container-fluid">
            <div class="row shop-fullwidth pt-sm--20 pb--60 pb-md--50 pb-sm--40">
                <div class="col-12">
                    <div class="shop-toolbar">
                        <div class="shop-toolbar__inner">
                            <div class="row align-items-center">
                                <div class="col-md-6 text-md-left text-center">
                                    <div class="shop-toolbar__left">
                                        <p class="product-pages">Showing {{count($products)}} results</p>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                            <div class="shop-toolbar__right">
                                                <a href="#" class="product-filter-btn shop-toolbar__btn">
                                                    <span>Filters</span>
                                                    <i></i>
                                                </a>
                                                <div class="product-ordering">
                                                    <a href="#" class="product-ordering__btn shop-toolbar__btn">
                                                        <span>Short By</span>
                                                        <i></i>
                                                    </a>
                                                    <ul class="product-ordering__list">
                                                        <li class="active"><a href="#">Sort by popularity</a></li>
                                                        <li><a href="#">Sort by average rating</a></li>
                                                        <li><a href="#">Sort by newness</a></li>
                                                        <li><a href="#">Sort by price: low to high</a></li>
                                                        <li><a href="#">Sort by price: high to low</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> --}}
                            </div>
                        </div>
                        {{-- <div class="advanced-product-filters">
                                    <div class="product-filter">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="product-widget product-widget--price">
                                                    <h3 class="widget-title">Price</h3>
                                                    <ul class="product-widget__list">
                                                        <li>
                                                            <a href="#">
                                                                <span class="ammount">₹20.00</span>
                                                                <span> - </span>
                                                                <span class="ammount">₹40.00</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span class="ammount">₹40.00</span>
                                                                <span> - </span>
                                                                <span class="ammount">₹50.00</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span class="ammount">₹50.00</span>
                                                                <span> - </span>
                                                                <span class="ammount">₹60.00</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span class="ammount">₹60.00</span>
                                                                <span> - </span>
                                                                <span class="ammount">₹80.00</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span class="ammount">₹80.00</span>
                                                                <span> - </span>
                                                                <span class="ammount">₹100.00</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span class="ammount">₹100.00</span>
                                                                <span> + </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="product-widget product-widget--brand">
                                                    <h3 class="widget-title">Brands</h3>
                                                    <ul class="product-widget__list">
                                                        <li>
                                                            <a href="#">
                                                                <span>Airi</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span>Mango</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span>Valention</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span>Zara</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="product-widget product-widget--color">
                                                    <h3 class="widget-title">Color</h3>
                                                    <ul class="product-widget__list product-color-swatch">
                                                        <li>
                                                            <a href="#"
                                                                class="product-color-swatch-btn blue">
                                                                <span class="product-color-swatch-label">Blue</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="product-color-swatch-btn green">
                                                                <span class="product-color-swatch-label">Green</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="product-color-swatch-btn pink">
                                                                <span class="product-color-swatch-label">Pink</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="product-color-swatch-btn red">
                                                                <span class="product-color-swatch-label">Red</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="product-color-swatch-btn grey">
                                                                <span class="product-color-swatch-label">Grey</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="product-widget product-widget--size">
                                                    <h3 class="widget-title">Size</h3>
                                                    <ul class="product-widget__list">
                                                        <li>
                                                            <a href="#">
                                                                <span>L</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span>M</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span>S</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span>XL</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <span>XXL</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn-close"><i class="fa fa-times" aria-hidden="true"></i></i></a>
                                    </div>
                                </div> --}}
                    </div>
                    <div class="shop-products">
                        <div class="row grid-space-20 xxl-block-grid-5">
                            @forelse($products as $product)
                            <div class="col-lg-3 col-sm-6 mb--40 mb-md--30">
                                <div class="airi-product">
                                    <div class="product-inner">
                                        <figure class="product-image">
                                            <div class="product-image--holder">
                                                <a href="{{ route('product',[$product->slug_url]) }}">

                                                    <img data-original="{!! asset('storage/images/products/'.$product->image_url) !!}"
                                                        alt="Product Image" class="primary-image lazy">

                                                    <img data-original="{!! asset('storage/images/products/'.$product->image_url1) !!}"
                                                        alt="Product Image" class="secondary-image lazy">
                                                </a>
                                            </div>
                                        </figure>
                                        <div class="product-info">
                                            <h3 class="product-title">
                                                <a
                                                    href="{{ route('product',[$product->slug_url]) }}">{{ Str::limit($product->title,15) }}</a>
                                                {{-- <span class="pull-right">
                                                    @for($i = 1; $i<= $product->rating; $i++)
                                                        <i class="fa fa-star rated" aria-hidden="true"></i>
                                                        @endfor
                                                        @for($i = 1; $i<= 5 - $product->rating; $i++)
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            @endfor
                                                </span> --}}
                                            </h3>

                                            {{-- <span class="product-price-wrapper">
                                                                <span class="money">₹{{ $product->buy_it_now_price }}</span>
                                            <span class="product-price-old">
                                                <span class="money">₹{{ $product->mrp }}</span>
                                            </span>
                                            </span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty

                            <div class="col-md-12">
                                <h3>No Product Found..</h3>
                            </div>

                            @endforelse
                        </div>
                    </div>
                    @if(count($products))
                    <nav class="pagination-wrap">
                        {{ $products->appends(request()->query())->links() }}
                    </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content Wrapper Start -->

@endsection