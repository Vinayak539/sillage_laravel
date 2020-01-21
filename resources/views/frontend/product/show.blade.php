@extends('layouts.master')
@section('title') {{ $product->title }} @endsection
@section('content')


<!-- Breadcrumb area Start -->
<div class="breadcrumb-area pt--70 pt-md--25">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>

                    <li class="current"><span> {{ $product->title }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<!-- Selected Offer modal start -->
<div class="modal fade" id="seleted-offer">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Selected Offer</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="ptb--10 plr--10">
                    <div class="col-md-12 offer_section">
                        <div class="selected-offer">
                            <h6 class="text-danger">No Offer Selected</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Selected Offer modal end -->

<!-- Main Content Wrapper Start -->
<div id="content" class="main-content-wrapper">
    <div class="page-content-inner enable-full-width">
        <div class="container-fluid">
            <div class="row pt--40">
                <div class="col-md-6 product-main-image">
                    <div class="product-image">
                        <div class="product-gallery vertical-slide-nav">
                            <div class="product-gallery__thumb">
                                <div class="product-gallery__thumb--image">
                                    <div class="airi-element-carousel nav-slider slick-vertical multi-images"
                                        data-slick-options='{
                                                    "slidesToShow": 3,
                                                    "slidesToScroll": 1,
                                                    "vertical": true,
                                                    "swipe": true,
                                                    "verticalSwiping": true,
                                                    "infinite": true,
                                                    "focusOnSelect": true,
                                                    "asNavFor": ".main-slider",
                                                    "arrows": true,
                                                    "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-up" },
                                                    "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-down" }
                                                }' data-slick-responsive='[
                                                    {
                                                        "breakpoint":992,
                                                        "settings": {
                                                            "slidesToShow": 4,
                                                            "vertical": false,
                                                            "verticalSwiping": false
                                                        }
                                                    },
                                                    {
                                                        "breakpoint":575,
                                                        "settings": {
                                                            "slidesToShow": 3,
                                                            "vertical": false,
                                                            "verticalSwiping": false
                                                        }
                                                    },
                                                    {
                                                        "breakpoint":480,
                                                        "settings": {
                                                            "slidesToShow": 2,
                                                            "vertical": false,
                                                            "verticalSwiping": false
                                                        }
                                                    }
                                                ]'>


                                    </div>
                                </div>
                            </div>
                            <div class="product-gallery__large-image">
                                <div class="gallery-with-thumbs">
                                    <div class="product-gallery__wrapper">
                                        <div class="airi-element-carousel main-slider product-gallery__full-image image-popup multi-images1"
                                            data-slick-options='{
                                                        "slidesToShow": 1,
                                                        "slidesToScroll": 1,
                                                        "infinite": true,
                                                        "arrows": false,
                                                        "asNavFor": ".nav-slider"
                                                    }'>


                                        </div>
                                        <div class="product-gallery__actions">
                                            <button class="action-btn btn-zoom-popup"><i class="fa fa-search-plus"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <span class="product-badge new">New</span> --}}
                    </div>
                </div>
                <!-- <div class="col-md-6 product-main-details mt--40 mt-md--10 mt-sm--30"> -->
                <div class="col-md-6 product-main-details mt-md--10 mt-sm--30">
                    <div class="product-summary">
                        {{-- <div class="product-rating float-left" id="product-rating">
                            @if($prod)
                            <span>
                                @for($i = 1; $i<= $prod->rating; $i++)
                                    <i class="fa fa-star rated" aria-hidden="true"></i>
                                    @endfor
                                    @for($i = 1; $i<= 5 - $prod->rating; $i++)
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        @endfor
                            </span>
                            @if($prod->total_rating)
                            <a href="javascript:void(0)" class="review-link">({{ $prod->total_rating }} customer
                        review)</a>
                        @endif
                        @else
                        <span>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </span>
                        @endif

                    </div> --}}

                    <a href="#" data-toggle="modal" data-target="#bulk-order"
                        class="btn btn-sm float-right bulk-order-btn">Bulk Order</a>

                    <div class="clearfix"></div>

                    <h3 class="product-titles">{{ $product->title }}</h3>

                    <div class="product-price-wrapper mb--10 mb-md--10">
                        <span class="money mrp"> <i class="fa fa-inr"></i> {{ $product->colors[0]->mrp }}</span>
                        <span class="old-price">
                            <span class="money starting_price"><i class="fa fa-inr"></i>
                                {{ $product->colors[0]->starting_price }}</span>
                        </span>
                    </div>
                    {{-- <h3 class="product-titles mrp">{{ $product->colors[0]->mrp }}</h3> --}}

                    @if($product->category)
                    <a href="{{ route('cate',[$product->category->slug_url]) }}" class="mb--10">
                        <span>{{ $product->category->name }}</span>
                    </a>
                    @endif

                    <div class="clearfix"></div>

                    <div class="variation-form mb--35">
                        @if(count($colorsSizes) > 0)
                        <div class="product-color-variations mb--20">
                            <p class="swatch-label">Color: <strong class="swatch-label color-label"></strong></p>
                            <div class="product-color-swatch variation-wrapper">
                                @foreach ($colorsSizes as $item)
                                <div class="swatch-wrapper"
                                    style="background: {{ $item->color_name }}; border: 1px solid {{ $item->color_name }}">
                                    <a class="product-color-swatch-btn variation-btn" data-toggle="tooltip"
                                        data-placement="top" title="{{ $item->color_name }}"
                                        data-color-id="{{ $item->color_id }}" data-mrp="{{ $item->mrp }}"
                                        data-stock="{{ $item->stock }}" data-map-id="{{ $item->map_id }}"
                                        data-product-id="{{ $product->id }}" data-title="{{ $item->color_name }}"
                                        data-starting-price="{{ $item->starting_price }}">
                                        <span class="product-color-swatch-label">{{ $item->color_name }}</span>
                                    </a>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        @endif

                        @if(count($product->sizes) > 0)
                        <div class="product-size-variations">
                            <p class="swatch-label">Size: <strong class="swatch-label size_lable"></strong></p>
                            <div class="product-size-swatch variation-wrapper">
                                @foreach ($product->sizes as $item)
                                <div class="swatch-wrapper">
                                    <a class="product-size-swatch-btn variation-btn size_btn" data-toggle="tooltip"
                                        data-placement="top" title="{{ $item->title }}"
                                        data-size-id="{{ $item->size_id }}">
                                        <span class="product-size-swatch-label">{{ $item->title }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Offer Section --}}

                    <div class="offerSection">
                        @if(count($offers))
                        <p>
                            Choose Any {{ $offers[0]->offered_quantity }} Offer On Purchase of {{
    $offers[0]->purchase_quantity }}
                        </p>
                        <div class="airi-element-carousel product-carousel nav-vertical-center offer"
                            data-slick-options='{
                                        "spaceBetween": 30,
                                        "slidesToShow": 6,
                                        "slidesToScroll": 1,
                                        "arrows": true,
                                        "prevArrow": "fa fa-angle-left",
                                        "nextArrow": "fa fa-angle-right"
                                        }' data-slick-responsive='[
                                            {"breakpoint":1200, "settings": {"slidesToShow": 6} },
                                            {"breakpoint":991, "settings": {"slidesToShow": 5} },
                                            {"breakpoint":450, "settings": {"slidesToShow": 4} }
                                        ]'>
                            @foreach($offers as $key => $offer)

                            <div class="airi-product offer_product" data-product-name="{{ $offer->product_name }}"
                                data-color="{{ $offer->color_name }}" data-size="{{ $offer->size_name }}"
                                data-index="{{ $key }}" data-purchase-quantity="{{ $offer->purchase_quantity }}"
                                data-offered-quantity="{{ $offer->offered_quantity }}"
                                data-offered-id="{{ $offer->offer_id }}" data-map-id="{{ $offer->map_id }}">
                                <div class="product-inner">
                                    <figure class="product-image">
                                        <div class="product-image--holder">
                                            <a href="javascript:void(0)">
                                                <img src="{!! asset('storage/images/products/' . $offer->image_url) !!}"
                                                    alt="Product Image" />
                                            </a>
                                        </div>
                                    </figure>
                                    <div class="product-info">
                                        <h3 class="product-title">
                                            <a href="javascript:void(0)">{{ $offer->product_name }}</a>
                                        </h3>
                                        <p class="product-title">
                                            <a
                                                href="javascript:void(0)">{{ $offer->color_name . '[' . $offer->size_name . ']' }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <a href="javascript:void(0)" class="selectedOfferBtn">View Selected Offer <i
                                class="fa fa-angle-double-right"></i></a>
                        @endif
                    </div>


                    {{-- End Offer Section --}}

                    <div class="form--action mt--20 mb--30 mb-sm--20">
                        <div class="product-action flex-row align-items-center">
                            <div class="quantity">
                                <input type="number" class="quantity-input" name="qty" id="qty" value="1" min="1">
                            </div>

                            <div id="button-box" style="margin-right: 10px;">
                                <a href="javascript:void(0)" class="button-show-pdt add-cart"><i
                                        class="fa fa-shopping-bag mr-2" aria-hidden="true"></i> ADD TO CART</a>
                            </div>
                            {{-- <div id="button-box" style="margin-right: 10px;">
                                    <a href="javascript:void(0)" class="button-cls-outline"><i class="fa fa-heart mr-2"
                                            aria-hidden="true"></i> WISHLIST</a>
                                </div> --}}
                        </div>
                    </div>
                    @if($product->within_days || $product->wrong_products || $product->faulty_products ||
                    $product->quality_issue)
                    <div class="row pt--20 pb--20 text-center return--policy">
                        <div class="col-sm-12 col-12">
                            <p class="text-left mb-3">Return Policy</p>
                        </div>
                        @if($product->within_days == true)
                        <div class="col-sm-3 col-6">
                            <span class="badge badge-success"><i class="fa fa-calendar-o"></i> </span>
                            <p>Within 7 <br /> Days</p>
                        </div>
                        @endif
                        @if($product->wrong_products == true)
                        <div class="col-sm-3 col-6">
                            <span class="badge badge-danger"><i class="fa fa-times-circle-o"></i>
                            </span>
                            <p>Wrong <br /> Product</p>
                        </div>
                        @endif
                        @if($product->faulty_products == true)
                        <div class="col-sm-3 col-6">
                            <span class="badge badge-primary"><i class="fa fa-ban"></i>
                            </span>
                            <p> Faulty <br /> Product</p>
                        </div>
                        @endif
                        @if($product->quality_issue == true)
                        <div class="col-sm-3 col-6">
                            <span class="badge badge-dark"><i class="fa fa-thumbs-o-down"></i>
                            </span>
                            <p>
                                Quality <br> Issue
                            </p>
                        </div>
                        @endif
                    </div>
                    @endif


                    {{-- description and review start --}}
                    <div class="product-data-tab border-bottom pb--40 pb-md--30 pb-sm--20 tab-style-4">
                        @if(count($product->reviews))
                        <div class="nav nav-tabs product-data-tab__head mb--40 mb-sm--30" id="product-tab"
                            role="tablist">
                            <a class="product-data-tab__link nav-link active" id="nav-description-tab" data-toggle="tab"
                                href="#nav-description" role="tab" aria-selected="true">
                                <span>Description</span>
                            </a>
                            <a class="product-data-tab__link nav-link" id="nav-reviews-tab" data-toggle="tab"
                                href="#nav-reviews" role="tab" aria-selected="true">
                                <span>Reviews ({{ $prod->total_rating }})</span>
                            </a>
                        </div>
                        @endif
                        <div class="tab-content product-data-tab__content" id="product-tabContent">
                            <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
                                aria-labelledby="nav-description-tab">
                                <div class="product-description">
                                    <div class="pdp-productDescriptorsContainer">
                                        <div>
                                            <h4 class="pdp-product-description-title">
                                                Product Details <span
                                                    class="fa fa-list-alt myntraweb-sprite pdp-productDetailsIcon sprites-productDetailsIcon"></span>
                                            </h4>
                                            <p class="pdp-product-description-content">{{ $product->description }}
                                            </p>
                                        </div>
                                        <div class="pdp-sizeFitDesc">
                                            <h4 class="pdp-sizeFitDescTitle pdp-product-description-title">Material
                                                &amp; Care</h4>
                                            <p class="pdp-sizeFitDescContent pdp-product-description-content">
                                                {{ $product->material->material_name }}</p>
                                        </div>
                                        <div class="index-sizeFitDesc">
                                            <h4 class="index-sizeFitDescTitle index-product-description-title"
                                                style="padding-bottom: 12px;">Specifications
                                            </h4>
                                            <div class="index-tableContainer">
                                                @if($product->brand)
                                                <div class="index-row">
                                                    <div class="index-rowKey">Brand</div>
                                                    <div class="index-rowValue">{{ $product->brand->brand_name }}
                                                    </div>
                                                </div>
                                                @endif
                                                @if($product->condition)
                                                <div class="index-row">
                                                    <div class="index-rowKey">Condition</div>
                                                    <div class="index-rowValue">{{ $product->condition->condition }}
                                                    </div>
                                                </div>
                                                @endif
                                                @if($product->length)
                                                <div class="index-row">
                                                    <div class="index-rowKey">Length</div>
                                                    <div class="index-rowValue">{{ $product->length }}</div>
                                                </div>
                                                @endif
                                                @if($product->breadth)
                                                <div class="index-row">
                                                    <div class="index-rowKey">Breadth</div>
                                                    <div class="index-rowValue">{{ $product->breadth }}</div>
                                                </div>
                                                @endif
                                                @if($product->height)
                                                <div class="index-row">
                                                    <div class="index-rowKey">Height</div>
                                                    <div class="index-rowValue">{{ $product->height }}</div>
                                                </div>
                                                @endif
                                                @if($product->weight)
                                                <div class="index-row">
                                                    <div class="index-rowKey">Weight</div>
                                                    <div class="index-rowValue">{{ $product->weight }}</div>
                                                </div>
                                                @endif
                                                @if($product->warranty)
                                                <div class="index-row">
                                                    <div class="index-rowKey">Warranty</div>
                                                    <div class="index-rowValue">{{ $product->warranty->title }}
                                                    </div>
                                                </div>
                                                @endif
                                                @foreach($product->custom_fields as $field)
                                                <div class="index-row">
                                                    <div class="index-rowKey">{{ $field->field_name }}</div>
                                                    <div class="index-rowValue">{{ $field->field_value }}</div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-reviews" role="tabpanel"
                                aria-labelledby="nav-reviews-tab">
                                <div class="product-reviews">
                                    <ul class="review__list">
                                        @foreach($product->reviews as $review)
                                        <li class="review__item">
                                            <div class="review__container">

                                                <img alt="Review Avatar" class="review__avatar lazy"
                                                    data-original="{!! asset('assets/img/others/comment-icon-2.png') !!}">

                                                <div class="review__text">
                                                    <div class="product-rating float-right">
                                                        <span>
                                                            @for($i = 1; $i<= $review->rating; $i++)
                                                                <i class="fa fa-star rated" aria-hidden="true"></i>
                                                                @endfor
                                                                @for($i = 1; $i<= 5 - $review->rating; $i++)
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    @endfor
                                                        </span>
                                                    </div>
                                                    <div class="review__meta">
                                                        <strong class="review__author">{{ $review->name }} </strong>
                                                        <span class="review__dash">-</span>
                                                        <span
                                                            class="review__published-date">{{ date('F d, Y', strtotime($review->created_at)) }}</span>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p class="review__description">
                                                        {{ $review->comment }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- description and review end --}}
                </div>
            </div>
        </div>

        {{-- Releted Products --}}
        <div class="row pt--35 pt-md--25 pt-sm--15 pb--75 pb-md--55 pb-sm--35">
            <div class="col-12">
                <div class="row mb--40 mb-md--30">
                    <div class="col-12 text-center">
                        <h2 class="heading-secondary">Related Products</h2>
                        <hr class="separator center mt--25 mt-md--15">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="airi-element-carousel product-carousel nav-vertical-center" data-slick-options='{
                                        "spaceBetween": 30,
                                        "slidesToShow": 4,
                                        "slidesToScroll": 1,
                                        "arrows": true,
                                        "prevArrow": "fa fa-angle-left",
                                        "nextArrow": "fa fa-angle-right"
                                        }' data-slick-responsive='[
                                            {"breakpoint":1200, "settings": {"slidesToShow": 3} },
                                            {"breakpoint":991, "settings": {"slidesToShow": 2} },
                                            {"breakpoint":450, "settings": {"slidesToShow": 1} }
                                        ]'>

                            @foreach($related_products as $rproduct)
                            <div class="airi-product">
                                <div class="product-inner">
                                    <figure class="product-image">
                                        <div class="product-image--holder">
                                            <a href="{{ route('product',[$rproduct->slug_url]) }}">
                                                <img alt="Product Image" class="primary-image lazy"
                                                    data-original="{!! asset('storage/images/products/' . $rproduct->image_url) !!}">

                                                <img alt="Product Image" class="secondary-image lazy"
                                                    data-original="{!! asset('storage/images/products/' . $rproduct->image_url1) !!}">
                                            </a>
                                        </div>
                                    </figure>
                                    <div class="product-info">
                                        <h3 class="product-title">
                                            <a
                                                href="{{ route('product',[$rproduct->slug_url]) }}">{{ Str::limit($rproduct->title,15) }}</a>
                                            <span class="pull-right">
                                                @for($i = 1; $i<= $rproduct->rating; $i++)
                                                    <i class="fa fa-star rated" aria-hidden="true"></i>
                                                    @endfor
                                                    @for($i = 1; $i<= 5 - $rproduct->rating; $i++)
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        @endfor
                                            </span>
                                        </h3>

                                        <span class="pull-left">
                                            <a
                                                href="{{ route('cate',[$product->category->slug_url]) }}">{{ $product->category->name}}</a>
                                        </span>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content Wrapper Start -->
<!-- The Modal -->
<div class="modal fade" id="bulk-order">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Enquire For Bulk Order</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="ptb--30 plr--30">
                    <form class="form" action="#" id="contact-form">
                        <div class="form__group mb--20">
                            <input type="text" name="name" class="form__input form__input--2" placeholder="Your name*">
                        </div>
                        <div class="form__group mb--20">
                            <input type="email" name="email" class="form__input form__input--2"
                                placeholder="Email Address*">
                        </div>
                        <div class="form__group mb--20">
                            <input type="text" name="contact" class="form__input form__input--2"
                                placeholder="Your Phone*">
                        </div>
                        <div class="form__group mb--20">
                            <textarea class="form__input form__input--textarea" name="message"
                                placeholder="Message*"></textarea>
                        </div>
                        <div class="form__group text-center">
                            <input type="submit" value="Send" class="btn btn-submit btn-style-1">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('own-creation', $product->slug_url) }}" method="get" id="formCustomization">
    <input type="hidden" name="color_id" id="cust_color_id">
</form>

<form action="{{ route('cart.store') }}" method="post" id="cartForm">
    @csrf
    <input type="hidden" name="prod_id" id="cart_prod_id" value="{{ $product->id }}">
    <input type="hidden" name="qty" id="cart_qty">
    <input type="hidden" name="color_id" id="cart_color_id">
    <input type="hidden" name="size_id" id="cart_size_id">
</form>

@endsection

@section('extracss')
<style>
    .bulk-order-btn {
        padding: 4px 10px 1px;
        font-size: 12px;
    }

    .table th {
        font-weight: 600;

    }

    .table td,
    .table th {
        font-size: 14px !important;
        padding: 10px 0 10px 5px !important;
        text-transform: capitalize !important;
    }

    .disabledClass {
        cursor: not-allowed;
        text-decoration-line: line-through;
        text-decoration-style: solid;
        color: rgba(0, 0, 0, .6);
        /* background-color: #f5f5f5; */
        box-shadow: none;
        pointer-events: none;
        border-color: transparent;
        background: url("{!! asset('/assets/img/cross.png') !!}");
        background-size: 50% 50%;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>

<script type='text/javascript'
    src='https://platform-api.sharethis.com/js/sharethis.js#property=5ccc480d0ff462001290decd&product=inline-share-buttons&cms=website'
    async='async'></script>
@endsection

@section('extrajs')
<script>
    $(document).ready(function () {
            
            var color_id = $('.product-color-swatch-btn').attr('data-color-id');
            var title = $('.product-color-swatch-btn').attr('data-title');

            volume(color_id, title);

            sessionStorage.clear();

        var offers = JSON.parse(sessionStorage.getItem('offers')) || {};

        $('.offer_product').click(function () {

            var pname = $(this).attr('data-product-name');
            var pcolor = $(this).attr('data-color');
            var psize = $(this).attr('data-size');
            var index = $(this).attr('data-index');
            var offer_id = $(this).attr('data-offered-id');

            var map_id = $(this).attr('data-map-id');
            var pquantity = $(this).attr('data-purchase-quantity');
            var oquantity = $(this).attr('data-offered-quantity');
            var quantity = $('.quantity-input').val();

            if (quantity >= pquantity) {

                if (!offers[index]) {
                    offers[index] = {};
                    offers[index] = {
                        'name': pname,
                        'color': pcolor,
                        'size': psize,
                        'offer_id': offer_id,
                        'map_id': map_id,
                    };
                } else {
                    delete offers[index];
                }

                sessionStorage.setItem("offers", JSON.stringify(offers));


                // Offer Designing goes here
            } else {
                swal('Invalid', 'On Purchase of ' + pquantity + ' Choose Any ' + oquantity, 'error');
            }


        });

        $('.selectedOfferBtn').click(function () {

            $('#seleted-offer').modal('show');

            var offers = JSON.parse(sessionStorage.getItem("offers"));

            var html = '';

            if (offers) {

                for (let key in offers) {

                    html += ` <div class="selected-offer">
                        <h6>Name : ${offers[key].name} </h6>
                        <h6>Color : ${offers[key].color}</h6>
                        <h6>Size : ${offers[key].size}</h6>
                    </div>`;
                }

                $('.offer_section').html(html);

            }

        });

            $('.customize_btn').click(function(){

                var color_id = $('#cart_color_id').val();

                if (color_id.length < 1) {

                    swal('Warning', 'Please Choose Color', 'error');

                } else {

                    $('#cust_color_id').val(color_id);

                    $(this).html('<i class="fa fa-spinner fa-pulse fa-fw text-light"></i><span class="sr-only">Loading...</span>');
                    $('#formCustomization').submit();
                }

            });

            $('.add-cart').click(function () {

                var quantity = $('.quantity-input').val();

                var color_id = $('#cart_color_id').val();

                var size_id = $('#cart_size_id').val();

                if (color_id.length < 1) {

                    swal('Add to Cart', 'Please Choose Color', 'error');

                } else if (quantity < 1) {

                    swal('Add to Cart', 'Please Choose Atleast One Quantity to add in Cart', 'error');

                } else if (size_id.length < 1) {

                    swal('Add to Cart', 'Please Choose Size', 'error');

                } else {

                    $('#cart_qty').val(quantity);

                    $('#cartForm').submit();

                    $(this).html(
                        '<i class="fa fa-spinner fa-pulse fa-fw text-light"></i><span class="sr-only">Loading...</span>'
                    );
                }
            });

            $('#product-rating').click(function (event) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: $("#nav-reviews-tab").offset().top - 130
                }, 2000);
                $('#nav-description').removeClass('active show');
                $('#nav-description-tab').removeClass('active');
                $('#nav-reviews-tab').addClass('active');
                $('#nav-reviews').addClass('active show');
            });

            $('.popup-close').on('click', function (e) {
                e.preventDefault();
                $('#bulk-order').fadeOut('slow');
            });

            $('.product-color-swatch-btn').click(function (e) {

                var item = $('.product-color-swatch-btn').hasClass('active');
                if(item){
                    $('.product-color-swatch-btn').removeClass('active')
                }

                $(this).addClass('active')

                var mrp = $(this).attr('data-mrp');
                var product_id = $(this).attr('data-product-id');
                var color_id = $(this).attr('data-color-id');
                var map_id = $(this).attr('data-map-id');
                var stock = $(this).attr('data-stock');
                var starting_price = $(this).attr('data-starting-price');
                var title = $(this).attr('data-title');
                $('.size_lable').html('');
                $('#cart_size_id').val('')

                if (stock <= 0) {

                    $('#out_of_stock').show();
                    $('#out_of_stock').html('Out Of Stock');
                    $('.add-cart').attr('disabled', 'disabled');

                } else {

                    $("#cart_prod_id").val(product_id);
                    $("#cart_map_id").val(map_id);
                    $("#cart_color_id").val(color_id);
                    $('.mrp').html('<i class="fa fa-inr"></i> ' + mrp);

                    $('.starting_price').html('<i class="fa fa-inr"></i> ' + starting_price);
                }

                volume(color_id, title);

                attachClickListener('.size_btn');

                            $(".disabledClass").parents('.swatch-wrapper').css({
                                "cursor": "no-drop",
                                "border": "1px solid red"
                            });


            });

            $('.product-size-swatch-btn').click(function () {
                var size_id = $(this).attr('data-size-id');
                $('#cart_size_id').val(size_id);
            });


            function volume(color_id, title) {


                $('#cart_color_id').val(color_id);
                $('.color-label').html(title);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                $.ajax({
                    url: "{{ route('get.sizes') }}",
                    type: 'POST',
                    data: {
                        product_id: "{{ $product->id }}",
                        color_id: color_id,
                    },
                    success: function (result) {
                        var success = result.success;
                        var images = result.color_images;
                        
                        if (success) {

                            var html = '';

                            var prodSize = {!! json_encode($product->sizes) !!}

                            var productSizeObj = {

                            };

                            success.forEach(size => {
                                if (!productSizeObj[size.size_id]) {
                                    productSizeObj[size.size_id] = {};
                                }
                                productSizeObj[size.size_id] = size;
                            });

                            prodSize.forEach(data => {

                                html += `<div class="swatch-wrapper"><a class="product-size-swatch-btn variation-btn size_btn ${productSizeObj[data.size_id]? (productSizeObj[data.size_id].size_id ? '' : 'disabledClass'): 'disabledClass'}" data-toggle="tooltip"
                                                data-placement="top" title="${data.title}" data-size-id="${data.size_id}" >
                                                <span class="product-size-swatch-label">${data.title}</span>
                                            </a>
                                        </div>`


                            });

                            imageHtml = '';
                            imageHtml1 = '';
                            
                            images.forEach(image => {

                                imageHtml += `<figure class="product-gallery__thumb--single">
                                    <img alt="Products" class="lazy"
                                        src="${window.location.origin}/storage/images/multi-products/${image.image_url}">

                                    </figure>`

                                imageHtml1 += `<figure class="product-gallery__image zoom">
                                    
                                    <img alt="Products" class="lazy"
                                        src="${window.location.origin}/storage/images/multi-products/${image.image_url}">

                                    </figure>`
                            });
                            
                            $('.multi-images').html(imageHtml);

                            $('.multi-images1').html(imageHtml1);

                            $('.multi-images').slick('unslick');

                            $('.multi-images1').slick('unslick');
                            
                            if ($.fn.slick) {
                                $('.multi-images').slick({
                                    slidesToShow: 3,
                                    slidesToScroll: 5,
                                    vertical: true,
                                    swipe:true,
                                    verticalSwiping:true,
                                    infinite:false,
                                    focusOnSelect:true,
                                    asNavFor: ".main-slider",
                                    arrows:true,
                                    prevArrow: {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-up" },
                                    nextArrow: {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-down" },
                                    responsive: [
                                                    {
                                                        breakpoint:992,
                                                        settings: {
                                                            slidesToShow: 4,
                                                            vertical: false,
                                                            verticalSwiping: false
                                                        }
                                                    },
                                                    {
                                                        breakpoint:575,
                                                        settings: {
                                                            slidesToShow: 3,
                                                            vertical: false,
                                                            verticalSwiping: false
                                                        }
                                                    },
                                                    {
                                                        breakpoint:480,
                                                        settings: {
                                                            slidesToShow: 2,
                                                            vertical: false,
                                                            verticalSwiping: false
                                                        }
                                                    }
                                                ]
                                });
                                $('.multi-images1').slick({
                                   
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    infinite: true,
                                    arrows: false,
                                    asNavFor: ".nav-slider"
                                });
                            }

                            $('.product-size-swatch').html(html);

                            attachClickListener('.size_btn');

                            $(".disabledClass").parents('.swatch-wrapper').css({
                                "cursor": "no-drop",
                                "border": "1px solid red"
                            });


                        }
                    }
                });
            }

            function attachClickListener(elementName) {
                const elements = $(elementName);

                elements.each((index, element) => {
                   
                    element.addEventListener('click', function () {
                        var size_id = $(element).attr('data-size-id');

                        var title = $(element).attr('title');

                        $('.size_lable').html(title);

                        if ($(this).hasClass('disabledClass')) {

                            $('#cart_size_id').val('')

                            $('.size_lable').html(title + ' ' +
                                '<strong class="text-danger">Out of Stock</strong>');

                        } else {

                            $('#cart_size_id').val(size_id);
                            var item = $('.product-size-swatch-btn').hasClass('active');
                            if(item){
                                $('.product-size-swatch-btn').removeClass('active')
                            }
                            $(element).addClass('active')
                        }

                    });

                });

            }

        });

          function isOfferExists(key) {
        if (sessionStorage.getItem('offers') && sessionStorage.getItem('offers')[key]) {
            return true;
        }
        return false;
    }

</script>
@endsection