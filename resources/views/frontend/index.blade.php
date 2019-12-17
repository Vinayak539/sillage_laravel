@extends('layouts.master')
@section('title','Home')
@section('content')


<!-- Main Content Wrapper Start -->
<div id="content" class="main-content-wrapper">
    <!-- Banner Area Start -->
    <div class="banner-area mb--100 mb-lg--70">
        <diav class="airi-element-carousel nav-style-1 nav-center-bottom" data-slick-options='{
                    "slidesToShow" : 3,
                    "infinite": true,
                    "arrows": true,
                    "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-left" },
                    "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-right" }
                }' data-slick-responsive='[
                    {"breakpoint": 992, "settings": {"slidesToShow": 2}},
                    {"breakpoint": 576, "settings": {"slidesToShow": 1}}
                ]'>
            @foreach($sliders as $slider)
            <a href="{{ $slider->url }}" class="item">
                <div class="banner-box banner-info-center banner-hover-3">
                    <div class="banner-inner">
                        <div class="banner-image">

                            <img src="{!! asset('storage/images/sliders').'/'.$slider->image_url !!} " alt="{{ $slider->name }}">
                        </div>

                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <!-- Banner Area End -->

    <!-- Featured Product Start -->
    <div class="featured-product-area mb--40 mb-lg--63">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <figure class="full-img">

                        <img src="{!! asset('assets/images/bg/design2.jpg') !!} " alt="Featured Product Image">
                    </figure>
                </div>
                <div class="col-md-7">
                    <div class="text-block pl--40 pl-md--30 pl-sm--0 mt-sm--30">
                        <h2 class="heading-secondary-4">EXPLORE YOUR TRUE STYLE</h2>
                        <hr class="separator separator--3 mtb--25 mt-md--10 mb-md--10">
                        <p class="subheading-tag mb--20">Etiam imperdiet mauris lacus, id bibendum massa tincidunt nec.
                            Praesent efficitur sagittis ullamcorper. Maecenas tempor porttitor euismod. Nullam at ornare
                            nisl, vitae interdum magna. Vestibulum ante ipsum primis in faucibus</p>
                        <a href="#" class="btn-link btn-link--2">Check it out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured Product End -->

    @foreach($sections as $section)
    @if(count($section->msections))
    <!-- Trending Products area Start Here -->
    <section class="trending-products-area pt--30 pb--80 pt-md--20 pb-md--60">
        <div class="container-fluid">
            <div class="row mb--40 mb-md--30">
                <div class="col-12">
                    <h2 class="heading-secondary text-center">{{ $section->SectionName }}</h2>
                </div>
            </div>
            <div class="row">
                @foreach($section->msections as $msec)

                @php

                $product = DB::table('txn_products as p')
                ->selectRaw("p.id,p.title, p.image_url, p.buy_it_now_price,p.mrp,
                p.starting_price, p.slug_url, p.stock, FLOOR(AVG(txn_reviews.rating)) as
                rating , COUNT(txn_reviews.id) as total_rating")
                ->leftJoin("txn_reviews", "txn_reviews.product_id", "p.id")
                ->where('p.id', $msec->product_id)
                ->groupBy('p.id')
                ->first();
                @endphp
                <div class="col-xl-3 col-lg-4 col-sm-6 mb--40 mb-md--30">
                    <div class="airi-product">
                        <div class="product-inner">
                            <figure class="product-image">
                                <div class="product-image--holder">
                                    <a href="{{ route('product',[$product->slug_url]) }}">

                                        <img src="{!! asset('storage/images/products').'/' !!}{{ $product->image_url }}"
                                            alt="{{ $product->title }}" class="primary-image">

                                        <img src="{!! asset('assets/img/products/prod-20-2.jpg') !!}  "
                                            alt="{{ $product->title }}" class="secondary-image">
                                    </a>
                                </div>
                                <div class="airi-product-action">
                                    <div class="product-action">

                                        <a class="add_to_cart_btn action-btn add-cart" href="javascript:void(0);"
                                            title="add to cart" data-obj-id="{{ $product->id }}"
                                            data-obj-stock="{{ $product->stock }}" data-toggle="tooltip"
                                            data-placement="top" title="Add to Cart">
                                            <i class="dl-icon-cart29"></i>
                                        </a>

                                    </div>
                                </div>
                            </figure>
                            <div class="product-info">
                                <h3 class="product-title">
                                    <a href="{{ route('product',[$product->slug_url]) }}">{{ $product->title }}</a>
                                </h3>
                                <div class="product-rating">
                                    <span>
                                        @for($i = 1; $i<= $product->rating; $i++)
                                        <i class="dl-icon-star rated"></i>
                                        @endfor
                                        @for($i = 1; $i<= 5 - $product->rating; $i++)
                                        <i class="dl-icon-star"></i>
                                        @endfor
                                    </span>
                                </div>
                                <span class="product-price-wrapper">
                                    <span class="money">₹ {{ $product->buy_it_now_price }}</span>
                                    <span class="product-price-old">
                                        <span class="money">₹ {{ $product->mrp }}</span>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

               
            </div>
        </div>
    </section>
@endif
@endforeach
<!-- Trending Products area End Here -->

<!-- Fullwidth Banner area Start Here -->
<section class="fullwide-banner position-relative bg-color pt--85 pt-md--70 pb--85 pb-md--70" data-bg-color="#ecf3e9">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-sm--50">
                <figure class="text-right">
                    <img src="https://static.cdn.printful.com/static/v740/images/landing/make-shirt/make-money-with-shirt.svg"
                        alt="Banner Image">
                </figure>
            </div>
            <div class="col-md-6 text-center">
                <p class="text-uppercase font-bold font-size-16 color--dark-5">Make money with your t-shirt design
                </p>
                <h2 class="fullwide-banner-title-6 text-uppercase">Turn your idea into profit - start selling
                    customized shirts with your design online!</h2>
                <a href="#" class="btn btn-link ">Shop Now</a>
            </div>
        </div>
    </div>
</section>
<!-- Fullwidth Banner area End Here -->

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
                                        <img src="{!! asset('storage/images/testimonials').'/' !!}{{ $testimonial->image_url }}" alt="Client"
                                            class="testimonial__author--img">
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
