@extends('layouts.master')
@section('title','Home')
@section('content')

<div id="content" class="main-content-wrapper">
    <div class="homepage-slider" id="homepage-slider-1">
        <div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="home-07"
            data-source="gallery"
            style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
            <!-- START REVOLUTION SLIDER 5.4.7 fullwidth mode -->
            <div id="rev_slider_4_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.7">
                <ul>
                    <!-- SLIDE  -->
                    @foreach($sliders as $key=>$slider)
                    <li onclick="window.location.href='{{ $slider->url }}'" style="cursor: pointer;" data-index="rs-9"
                        data-transition="random-premium" data-slotamount="default" data-hideafterloop="0"
                        data-hideslideonmobile="off" data-easein="default" data-easeout="default"
                        data-masterspeed="default"
                        data-thumb="{!! asset('storage/images/sliders').'/'.$slider->image_url !!}" data-rotate="0"
                        data-saveperformance="off" data-title="0{{ $key+1 }}" data-param1="" data-param2=""
                        data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8=""
                        data-param9="" data-param10="" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="{!! asset('storage/images/sliders').'/'.$slider->image_url !!}"
                            alt="{{ $slider->name }}" data-bgposition="center center" data-bgfit="100%"
                            data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                        <!-- LAYERS -->
                    </li>
                    @endforeach
                    <!-- SLIDE  -->
                </ul>
                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
            </div>
        </div><!-- END REVOLUTION SLIDER -->
    </div>
</div>

{{-- Feature Start --}}
<section class="collection-banner">
    <div class="container">
        <div class="row collection2">
            <div class="col-md-4">
                <div class="collection-banner-main banner-1 p-left"
                    onclick="window.location.href='{{ route('cate','t-shirt-3') }}'">
                    <div class="collection-img bg-size"
                        style="background-image: url('{{ asset("assets/img/men-tshirt.jpg") }}');background-size: cover;background-position: center center;display: block;">
                    </div>
                    <div class="collection-banner-contain ">
                        <div>
                            <h3>Apparel</h3>
                            <h4>Men's T-Shirts</h4>
                            <div class="shop">
                                <a href="{{ route('cate','t-shirt-3') }}">
                                    shop now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection-banner-main banner-1 p-left"
                    onclick="window.location.href='{{ route('cate','t-shirt-6') }}'">
                    <div class="collection-img bg-size"
                        style="background-image: url('{{ asset("assets/img/women-tshirt.jpg") }}');background-size: cover;background-position: center center;display: block;">
                    </div>
                    <div class="collection-banner-contain ">
                        <div>
                            <h3>Apparel</h3>
                            <h4>Women's T-Shirts</h4>
                            <div class="shop">
                                <a href="{{ route('cate','t-shirt-6') }}">
                                    shop now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="collection-banner-main banner-1 p-left"
                    onclick="window.location.href='{{ route('cate','fr-7') }}'">
                    <div class="collection-img bg-size"
                        style="background-image: url('{{ asset("assets/img/perfumes.jpg") }}');background-size: cover;background-position: center center;display: block;">
                        {{-- <img src="{{ asset("assets/img/men-tshirt.jpg") }}" class="img-fluid bg-img "
                        alt="banner" style="display: none;"> --}}
                    </div>
                    <div class="collection-banner-contain ">
                        <div>
                            <h3>Fragrance</h3>
                            <h4>Men Fragrance</h4>
                            <div class="shop">
                                <a href="{{ route('cate','fr-7') }}">
                                    shop now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Feature End --}}

@if(count($homeOfferSliders))
<section class="offer-section">
    <div class="container">
        <div class="airi-element-carousel nav-vertical-center nav-style-1 homeOffer" data-slick-options='{
            "slidesToShow" : 1,
            "arrows": true,
            "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-double-left" },
            "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-double-right" }
        }'>
            @foreach($homeOfferSliders as $homeOfferSlider)
            <a href="{{ $homeOfferSlider->url }}" class="item">
                <img src="{!! asset('storage/images/home-offer-sliders').'/'.$homeOfferSlider->image_url !!}"
                    alt="offer">
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@foreach($sections as $key=>$section)
@if(count($section->msections))
<!-- Trending Products area Start Here -->
<section class="trending-products-area pt--30 pb--30 pt-md--20 pb-md--20">
    <div class="container">
        <div class="row mb--25 mb-md--30">
            <div class="col-12">
                <h2 class="heading-secondary section-product-title">{{ $section->SectionName }}
                    <span>({{ count($section->msections) }})</span></h2>
                <div class="title-border"></div>
            </div>
        </div>
        <div class="row">
            @foreach($section->msections as $key => $msec)

            @php

            $product = DB::table('txn_products as p')
            ->selectRaw("p.id,p.title,p.slug_url, p.image_url, w.id as w_id, w.product_id as w_product_id, p.image_url1,
            p.review_status,map.color_id as c_id, map.size_id as s_id, map.mrp, map.starting_price,
            GROUP_CONCAT(DISTINCT(c.color_code)) as color_codes,
            FLOOR(AVG(txn_reviews.rating)) as
            rating , COUNT(txn_reviews.id) as total_rating")
            ->leftJoin("txn_reviews", "txn_reviews.product_id", "p.id")
            ->leftJoin("map_color_sizes as map", "map.product_id", "p.id")
            ->leftJoin("mst_colors as c", "c.id", "map.color_id")
            ->leftJoin("wishlists as w", "w.product_id", "p.id")
            ->where('p.id', $msec->product_id)
            ->where('p.status', true)
            ->groupBy('p.id')
            ->first();

            @endphp

            @if($product)
            <div class="col-md-3 col-6 mb--30">
                {{-- <div class="airi-element-carousel product-carousel nav-vertical-center" data-slick-options='{
                            "spaceBetween": 30,
                            "slidesToShow": 4,
                            "slidesToScroll": 1,
                            "arrows": true,
                            "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-left" },
                            "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-right" }
                            }' data-slick-responsive='[
                                {"breakpoint":1200, "settings": {"slidesToShow": 3} },
                                {"breakpoint":991, "settings": {"slidesToShow": 2} },
                                {"breakpoint":450, "settings": {"slidesToShow": 2} }
                            ]'> --}}


                <div class="airi-product">
                    <div class="product-inner">
                        <figure class="product-image">
                            <div class="product-image--holder">
                                <a href="{{ route('product', $product->slug_url) }}">

                                    <img data-src="{!! asset('storage/images/products/' . $product->image_url) !!}"
                                        alt="{{ $product->title }}" class="primary-image lazy">

                                    <img data-src="{!! asset('storage/images/products/'. $product->image_url1) !!}"
                                        alt="{{ $product->title }}" class="secondary-image lazy">
                                </a>
                            </div>
                            <span class="product-trending">Trending</span>
                            @if(auth('user')->check())
                            @if(auth('user')->user()->id && $product->w_product_id == $product->id)
                            <span class="product-badge fav wishlist-remove" data-w-id="{{ $product->w_id }}"><i
                                    class="fa fa-heart colorfull-heart" aria-hidden="true" title="Remove from Wishlist"></i></span>
                            @else
                            <span class="product-badge fav wishlist" data-p-id="{{ $product->id }}"
                                data-c-id="{{ $product->c_id }}" data-s-id="{{ $product->s_id }}" title="Add to Wishlist"><i
                                    class="fa fa-heart-o" aria-hidden="true"></i></span>
                            @endif
                            @else
                            <span class="product-badge fav wishlist-login"><i class="fa fa-heart-o"
                                    aria-hidden="true"></i></span>
                            @endif
                        </figure>

                        <!-- Color  -->
                        @php
                        $colors = explode(",", $product->color_codes);
                        $getDiff = $product->starting_price - $product->mrp;
                        $getOffer = round(($getDiff / $product->starting_price) * 100, 0);
                        @endphp


                        <!-- Color End -->
                        <div class="product-info">
                            <h3 class="product-title">
                                <a href="{{ route('product',$product->slug_url) }}">{{ $product->title }}</a>
                            </h3>
                            <span class="product-price-wrapper">
                                <span class="money"><i class="fa fa-inr"></i> {{ $product->mrp }}</span>
                                <span class="product-price-old">
                                    <span class="money"><i class="fa fa-inr"></i> {{ $product->starting_price }}</span>
                                </span>
                                <span style="color:#388e3c">
                                    {{ $getOffer }}% off
                                </span>
                                @if($product->review_status)
                                <span class="pull-right">
                                    @for($i = 1; $i<= $product->rating; $i++)
                                        <i class="fa fa-star rated" aria-hidden="true"></i>
                                        @endfor
                                        @for($i = 1; $i<= 5 - $product->rating; $i++)
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            @endfor
                                </span>
                                @endif
                            </span>
                            @if(!$product->review_status)
                            @if(count($colors)>4)
                            <span class="pull-right">
                                @for($i=0; $i < 4; $i++) <span
                                    style="background: {{ $colors[$i] }};border-radius:50%;height:10px;width:10px;display:inline-block;box-shadow: 1px 2px 3px 0px #5f5f5f">
                            </span>
                            @endfor
                            </span>
                            @else
                            <span class="pull-right">
                                @foreach($colors as $color)
                                <span
                                    style="background: {{ $color }};border-radius:50%;height:10px;width:10px;display:inline-block;box-shadow: 1px 2px 3px 0px #5f5f5f"></span>
                                @endforeach
                            </span>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>

                {{-- </div> --}}
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif
@endforeach
<!-- Trending Products area End Here -->
</div>

<!-- Main Content Wrapper Start -->


<!-- ----------Meet Our Team and Clientells start------------ -->
@if(count($testimonials))
<div id="content" class="main-content-wrapper">
    <div class="page-content-inner">
        <div class="container">

            <div class="row pt--30 pt-md--20 pt-sm--10 pb--75 pb-md--55 pb-sm--35">
                <div class="col-12">
                    <div class="row mb--35 mb-md--25">
                        <div class="col-12 text-center">
                            <h3 class="heading-tertiary heading-color">What Client Say ?</h3>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="airi-element-carousel testimonial-carousel" data-slick-options='{
                                "slidesToShow": 1,
                                "slidesToScroll": 1
                            }'>
                                @foreach($testimonials as $testimonial)
                                <div class="testimonial testimonial-style-3">
                                    <div class="testimonial__inner">
                                        @if($testimonial->image_url)
                                        <img src="{!! asset('storage/images/testimonials').'/' !!}{{ $testimonial->image_url }}"
                                            alt="Client" class="testimonial__author--img">
                                        @else
                                        <img src="{!! asset('assets/img/others/happy-client-1.jpg') !!} " alt="Client"
                                            class="testimonial__author--img">
                                        @endif
                                        <p class="testimonial__desc">{{ $testimonial->description }}</p>
                                        <div class="testimonial__author">
                                            <h3 class="testimonial__author--name">{{ $testimonial->name }}</h3>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <!-- <div class="col-12 text-center">
                            <button type="button" class="btn secondary ">View More</button>
                        </div> -->

                </div>

            </div>

        </div>
    </div>
</div>
@endif
<!-- ----------Meet Our Team and Clientells end------------ -->
@endsection
@section('extrajs')

<script>
    $(document).ready(function () {


        $('.add-cart').click(function () {
            var val = $(this).attr('data-obj-id');
            var stock = $(this).attr('data-obj-stock');

            if (stock > 0) {

                $('#prod_id').val(val);
                $('#cartForm').submit();
                $(this).html(
                    '<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span>'
                );

            } else {
                swal({
                    title: "Out of Stock !",
                    text: "Product is currently Out of Stock !",
                    type: "warning",
                    closeOnConfirm: false
                });
            }
        });
        // $(".out-of-stock").prev().addClass("active");
    });

</script>

@endsection
