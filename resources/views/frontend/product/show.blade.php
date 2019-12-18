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
                                    <div class="airi-element-carousel nav-slider slick-vertical" data-slick-options='{
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
                                        <figure class="product-gallery__thumb--single">

                                            <img src="{!! asset('storage/images/products').'/'.$product->image_url !!}"
                                                alt="Products">

                                        </figure>
                                        <figure class="product-gallery__thumb--single">

                                            <img src="{!! asset('storage/images/products').'/'.$product->image_url1 !!}"
                                                alt="Products">

                                        </figure>
                                        @if(count($product->images))

                                        @foreach($product->images as $image)
                                        <figure class="product-gallery__thumb--single">

                                            <img src="{!! asset('storage/images/multi-products').'/'.$image->image_url !!}"
                                                alt="Products">

                                        </figure>
                                        @endforeach

                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="product-gallery__large-image">
                                <div class="gallery-with-thumbs">
                                    <div class="product-gallery__wrapper">
                                        <div class="airi-element-carousel main-slider product-gallery__full-image image-popup"
                                            data-slick-options='{
                                                        "slidesToShow": 1,
                                                        "slidesToScroll": 1,
                                                        "infinite": true,
                                                        "arrows": false,
                                                        "asNavFor": ".nav-slider"
                                                    }'>
                                            <figure class="product-gallery__image zoom">

                                                <img src="{!! asset('storage/images/products').'/'.$product->image_url !!}"
                                                    alt="Product">

                                            </figure>
                                            <figure class="product-gallery__image zoom">

                                                <img src="{!! asset('storage/images/products').'/'.$product->image_url1 !!}"
                                                    alt="Product">

                                            </figure>
                                            @if(count($product->images))

                                            @foreach($product->images as $image)
                                            <figure class="product-gallery__image zoom">

                                                <img src="{!! asset('storage/images/multi-products').'/'.$image->image_url !!}"
                                                    alt="Product">

                                            </figure>
                                            @endforeach

                                            @endif
                                        </div>
                                        <div class="product-gallery__actions">
                                            <button class="action-btn btn-zoom-popup"><i
                                                    class="dl-icon-zoom-in"></i></button>
                                            <!-- <a href="https://www.youtube.com/watch?v=Rp19QD2XIGM"
                                                    class="action-btn video-popup"><i class="dl-icon-format-video"></i></a> -->
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
                        <div class="product-rating float-left" id="product-rating">
                            @if($prod)
                            <span>
                                @for($i = 1; $i<= $prod->rating; $i++)
                                    <i class="dl-icon-star rated"></i>
                                    @endfor
                                    @for($i = 1; $i<= 5 - $prod->rating; $i++)
                                        <i class="dl-icon-star"></i>
                                        @endfor
                            </span>
                            @if($prod->total_rating)
                            <a href="javascript:void(0)" class="review-link">({{ $prod->total_rating }} customer
                                review)</a>
                            @endif
                            @else
                            <span>
                                <i class="dl-icon-star"></i>
                                <i class="dl-icon-star"></i>
                                <i class="dl-icon-star"></i>
                                <i class="dl-icon-star"></i>
                                <i class="dl-icon-star"></i>
                            </span>
                            @endif

                        </div>
                        
                        <div class="clearfix"></div>
                        <h3 class="product-titles">{{ $product->title }}</h3>
                        @if($product->category)
                        <a href="{{ route('cate',[$product->category->slug_url]) }}" class="mb--10">
                            <span>{{ $product->category->name }}</span>
                        </a>
                        @endif
                        @if($product->stock == 0)
                        <span class="product-stock in-stock float-right text-danger">
                            <i class="fa fa-ban" aria-hidden="true"></i>
                            out of stock
                        </span>
                        @else
                        <span class="product-stock in-stock float-right text-success">
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            in stock
                        </span>
                        @endif


                        <div class="product-price-wrapper mb--30 mb-md--10">
                            <span class="money">₹{{ $product->buy_it_now_price }}</span>
                            <span class="old-price">
                                <span class="money">₹{{ $product->mrp }}</span>
                            </span>
                        </div>
                        <div class="clearfix"></div>





                        <!-- <div class="product-extra mb--10 mb-sm--20">

                            <a href="#" class="font-size-12"><i class="fa fa-exchange"></i>Delivery and
                                return</a>
                        </div> -->
                        <form action="#" class="variation-form mb--35">
                            <div class="product-color-variations mb--20">
                                <p class="swatch-label">Color: <strong class="swatch-label"></strong></p>
                                <div class="product-color-swatch variation-wrapper">
                                    <div class="swatch-wrapper">
                                        <a class="product-color-swatch-btn variation-btn blue" data-toggle="tooltip"
                                            data-placement="top" title="Blue">
                                            <span class="product-color-swatch-label">Blue</span>
                                        </a>
                                    </div>
                                    <div class="swatch-wrapper">
                                        <a class="product-color-swatch-btn variation-btn green" data-toggle="tooltip"
                                            data-placement="top" title="Green">
                                            <span class="product-color-swatch-label">Green</span>
                                        </a>
                                    </div>
                                    <div class="swatch-wrapper">
                                        <a class="product-color-swatch-btn variation-btn pink" data-toggle="tooltip"
                                            data-placement="top" title="Pink">
                                            <span class="product-color-swatch-label">Pink</span>
                                        </a>
                                    </div>
                                    <div class="swatch-wrapper">
                                        <a class="product-color-swatch-btn variation-btn red" data-toggle="tooltip"
                                            data-placement="top" title="Red">
                                            <span class="product-color-swatch-label">Red</span>
                                        </a>
                                    </div>
                                    <div class="swatch-wrapper">
                                        <a class="product-color-swatch-btn variation-btn white" data-toggle="tooltip"
                                            data-placement="top" title="White">
                                            <span class="product-color-swatch-label">white</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-size-variations">
                                <p class="swatch-label">Size: <strong class="swatch-label"></strong></p>
                                <div class="product-size-swatch variation-wrapper">
                                    <div class="swatch-wrapper">
                                        <a class="product-size-swatch-btn variation-btn" data-toggle="tooltip"
                                            data-placement="top" title="L">
                                            <span class="product-size-swatch-label">L</span>
                                        </a>
                                    </div>
                                    <div class="swatch-wrapper">
                                        <a class="product-size-swatch-btn variation-btn" data-toggle="tooltip"
                                            data-placement="top" title="M">
                                            <span class="product-size-swatch-label">M</span>
                                        </a>
                                    </div>
                                    <div class="swatch-wrapper">
                                        <a class="product-size-swatch-btn variation-btn" data-toggle="tooltip"
                                            data-placement="top" title="S">
                                            <span class="product-size-swatch-label">S</span>
                                        </a>
                                    </div>
                                    <div class="swatch-wrapper">
                                        <a class="product-size-swatch-btn variation-btn" data-toggle="tooltip"
                                            data-placement="top" title="XL">
                                            <span class="product-size-swatch-label">XL</span>
                                        </a>
                                    </div>
                                    <div class="swatch-wrapper">
                                        <a class="product-size-swatch-btn variation-btn" data-toggle="tooltip"
                                            data-placement="top" title="XXL">
                                            <span class="product-size-swatch-label">XXL</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a href="" class="reset_variations">Clear</a>
                        </form>
                        <form action="#" class="form--action mt--20 mb--30 mb-sm--20">
                            <div class="product-action flex-row align-items-center">
                                <div class="quantity">
                                    <input type="number" class="quantity-input" name="qty" id="qty" value="1" min="1">
                                </div>

                                <div id="button-box" style="margin-right: 10px;">
                                    <a href="{{ route('cart') }}" class="button-cls sss">Add to cart</a>
                                </div>

                            </div>
                        </form>

                        <div
                            class="product-summary-footer d-flex justify-content-between flex-sm-row flex-column mt--20">
                            <div class="sharethis-inline-share-buttons"></div>
                            {{-- <div class="product-share-box">
                                    <span class="font-size-12">Share With</span>

                                    <ul class="social social-small">
                                        <li class="social__item">
                                            <a href="https://facebook.com/" class="social__link">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="social__item">
                                            <a href="https://twitter.com/" class="social__link">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>

                                    </ul>

                                </div> --}}
                        </div>

                    </div>
                </div>
            </div>

            <div class="row justify-content-center pt--45 pt-lg--50 pt-md--55 pt-sm--35">
                <div class="col-12">
                    <div class="product-data-tab tab-style-1">
                        <div class="nav nav-tabs product-data-tab__head mb--40 mb-md--30" id="product-tab"
                            role="tablist">
                            @if($product->description)
                            <a class="product-data-tab__link nav-link active" id="nav-description-tab" data-toggle="tab"
                                href="#nav-description" role="tab" aria-selected="true">
                                <span>Description</span>
                            </a>
                            @endif
                            @if(count($product->reviews))
                            <a class="product-data-tab__link nav-link" id="nav-reviews-tab" data-toggle="tab"
                                href="#nav-reviews" role="tab" aria-selected="true">
                                <span>Reviews ({{ $prod->total_rating }})</span>
                            </a>
                            @endif
                        </div>
                        <div class="tab-content product-data-tab__content" id="product-tabContent">
                            <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
                                aria-labelledby="nav-description-tab">
                                <div class="product-description">
                                    <p>
                                        {{ $product->description }}
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-reviews" role="tabpanel"
                                aria-labelledby="nav-reviews-tab">
                                <div class="product-reviews">
                                    <ul class="review__list">
                                        @foreach($product->reviews as $review)
                                        <li class="review__item">
                                            <div class="review__container">

                                                <img src="{!! asset('assets/img/others/comment-icon-2.png') !!} "
                                                    alt="Review Avatar" class="review__avatar">

                                                <div class="review__text">
                                                    <div class="product-rating float-right">
                                                        <span>
                                                            @for($i = 1; $i<= $review->rating; $i++)
                                                                <i class="dl-icon-star rated"></i>
                                                                @endfor
                                                                @for($i = 1; $i<= 5 - $review->rating; $i++)
                                                                    <i class="dl-icon-star"></i>
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



                                    <div class="review-form-wrapper">
                                        <span class="reply-title"><strong>Add a review</strong></span>
                                        <form action="#" class="needs-validation">
                                            <div class="form-notes mb--20">
                                                <p>Your email address will not be published. Required fields are
                                                    marked <span class="required">*</span></p>
                                            </div>
                                            <div class="form__group mb--30 mb-sm--20">
                                                <div class="revew__rating">
                                                    <p class="stars selected">
                                                        <a class="star-1 active" href="#">1</a>
                                                        <a class="star-2" href="#">2</a>
                                                        <a class="star-3" href="#">3</a>
                                                        <a class="star-4" href="#">4</a>
                                                        <a class="star-5" href="#">5</a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form__group mb--30 mb-sm--20">
                                                <div class="form-row">
                                                    <div class="col-sm-6 mb-sm--20">
                                                        <label class="form__label" for="name">Name<span
                                                                class="required">*</span></label>
                                                        <input type="text" name="name" id="name" class="form__input">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form__label" for="email">email<span
                                                                class="required">*</span></label>
                                                        <input type="email" name="email" id="email" class="form__input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form__group mb--30 mb-sm--20">
                                                <div class="form-row">
                                                    <div class="col-12">
                                                        <label class="form__label" for="email">Your Review<span
                                                                class="required">*</span></label>
                                                        <textarea name="review" id="review"
                                                            class="form__input form__input--textarea"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form__group">
                                                <div class="form-row">
                                                    <div class="col-12">
                                                        <input type="submit" value="Submit"
                                                            class="btn btn-style-1 btn-submit">
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
                                        "prevArrow": "dl-icon-left",
                                        "nextArrow": "dl-icon-right"
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
                                                    <img src="{!! asset('storage/images/products').'/'.$rproduct->image_url !!} "
                                                        alt="Product Image" class="primary-image">

                                                    <img src="{!! asset('storage/images/products').'/'.$rproduct->image_url1 !!} "
                                                        alt="Product Image" class="secondary-image">
                                                </a>
                                            </div>
                                            <div class="airi-product-action">
                                                <div class="product-action">
                                                    <a class="add_to_cart_btn action-btn" href="{{ route('cart') }}"
                                                        data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                                        <i class="dl-icon-cart29"></i>
                                                    </a>

                                                </div>
                                            </div>
                                        </figure>
                                        <div class="product-info">
                                            <h3 class="product-title">
                                                <a
                                                    href="{{ route('product',[$rproduct->slug_url]) }}">{{ $rproduct->title }}</a>
                                            </h3>
                                            
                                            <div class="product-rating">
                                                <span>
                                                    @for($i = 1; $i<= $rproduct->rating; $i++)
                                                        <i class="dl-icon-star rated"></i>
                                                        @endfor
                                                        @for($i = 1; $i<= 5 - $rproduct->rating; $i++)
                                                            <i class="dl-icon-star"></i>
                                                            @endfor
                                                </span>
                                            </div>
                                            <span class="pull-left">
                                                <a href="{{ route('cate',[$product->category->slug_url]) }}">{{$product->category->name}}</a>
                                            </span>
                                            <span class="product-price-wrapper pull-right">
                                                <span class="money">₹ {{ $rproduct->buy_it_now_price }}</span>
                                                <span class="product-price-old">
                                                    <span class="money">₹ {{ $rproduct->starting_price }}</span>
                                                </span>
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
@endsection
@section('extracss')
<style>
    .bulk-order-btn {
        padding: 2px 10px;
        font-size: 12px;
    }
    #st-1{
        z-index: 0 !important;
    }
</style>
<script type='text/javascript'
    src='https://platform-api.sharethis.com/js/sharethis.js#property=5ccc480d0ff462001290decd&product=inline-share-buttons&cms=website'
    async='async'></script>
@endsection
@section('extrajs')
<script>
    $(document).ready(function () {
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

    $('.popup-close').on('click', function(e){
        e.preventDefault();
        $('#bulk-order').fadeOut('slow');
    });
});
</script>
@endsection