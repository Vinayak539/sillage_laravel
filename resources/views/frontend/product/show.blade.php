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
                                            <button class="action-btn btn-zoom-popup"><i class="fa fa-search-plus" aria-hidden="true"></i></button>
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

                        </div>
                        <a href="#" data-toggle="modal" data-target="#bulk-order"
                            class="btn btn-sm float-right bulk-order-btn">Bulk Order</a>

                        <div class="clearfix"></div>
                        <h3 class="product-titles">{{ $product->title }}</h3>
                        <h3 class="product-titles mrp"></h3>
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


                        {{-- <div class="product-price-wrapper mb--30 mb-md--10">
                            <span class="money">₹{{ $product->buy_it_now_price }}</span>
                        <span class="old-price">
                            <span class="money">₹{{ $product->mrp }}</span>
                        </span>
                    </div> --}}
                    <div class="clearfix"></div>

                    <form action="#" class="variation-form mb--35">
                        @if(count($colorsSizes) > 0)
                        <div class="product-color-variations mb--20">
                            <p class="swatch-label">Color: <strong class="swatch-label"></strong></p>
                            <div class="product-color-swatch variation-wrapper">
                                @foreach ($colorsSizes as $item)
                                <div class="swatch-wrapper" style="background: {{ $item->color_name }}">
                                    <a class="product-color-swatch-btn variation-btn {{ $item->color_name }}"
                                        data-toggle="tooltip" data-placement="top" title="{{ $item->color_name }}"
                                        data-color-id="{{ $item->color_id }}" data-mrp="{{ $item->mrp }}"
                                        data-stock="{{ $item->stock }}" data-map-id="{{ $item->map_id }}"
                                        data-product-id="{{ $product->id }}">
                                        <span class="product-color-swatch-label">{{ $item->color_name }}</span>
                                    </a>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        @endif
                        @if(count($product->sizes) > 0)
                        <div class="product-size-variations">
                            <p class="swatch-label">Size: <strong class="swatch-label"></strong></p>
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
                    </form>
                    <form action="#" class="form--action mt--20 mb--30 mb-sm--20">
                        <div class="product-action flex-row align-items-center">
                            <div class="quantity">
                                <input type="number" class="quantity-input" name="qty" id="qty" value="1" min="1">
                            </div>

                            <div id="button-box" style="margin-right: 10px;">
                                <a href="javascript:void(0)" class="button-cls sss add-cart">Add to cart</a>
                            </div>
                            <div id="button-box">
                                <a href="{{ route('own-creation') }}" class="button-cls sss">Create Your Own
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row justify-content-center pt--45 pt-lg--50 pt-md--55 pt-sm--35">
            <div class="col-12">
                <div class="product-data-tab tab-style-1">
                    <div class="nav nav-tabs product-data-tab__head mb--40 mb-md--30" id="product-tab" role="tablist">
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
                        <div class="tab-pane fade" id="nav-reviews" role="tabpanel" aria-labelledby="nav-reviews-tab">
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
                                                <img src="{!! asset('storage/images/products').'/'.$rproduct->image_url !!} "
                                                    alt="Product Image" class="primary-image">

                                                <img src="{!! asset('assets/img/products/prod-12-4.jpg') !!} "
                                                    alt="Product Image" class="secondary-image">
                                            </a>
                                        </div>
                                        <div class="airi-product-action">
                                            <div class="product-action">
                                                <a class="add_to_cart_btn action-btn" href="{{ route('cart') }}"
                                                    data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
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
                                                    <i class="fa fa-star rated" aria-hidden="true"></i>
                                                    @endfor
                                                    @for($i = 1; $i<= 5 - $rproduct->rating; $i++)
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        @endfor
                                            </span>
                                        </div>
                                        <span class="pull-left">
                                            <a
                                                href="{{ route('cate',[$product->category->slug_url]) }}">{{$product->category->name}}</a>
                                        </span>
                                        {{-- <span class="product-price-wrapper pull-right">
                                            <span class="money">₹ {{ $rproduct->buy_it_now_price }}</span>
                                        <span class="product-price-old">
                                            <span class="money">₹ {{ $rproduct->starting_price }}</span>
                                        </span>
                                        </span> --}}
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



<form action="/cart" method="post" id="cartForm">
    @csrf
    <input type="hidden" name="prod_id" id="cart_prod_id">
    <input type="hidden" name="qty" id="cart_qty">
    <input type="hidden" name="map_id" id="cart_map_id">
</form>

@endsection

@section('extracss')
<style>
    .bulk-order-btn {
        padding: 2px 10px;
        font-size: 12px;
    }

</style>

<script type='text/javascript'
    src='https://platform-api.sharethis.com/js/sharethis.js#property=5ccc480d0ff462001290decd&product=inline-share-buttons&cms=website'
    async='async'></script>
@endsection

@section('extrajs')
<script>
    $(document).ready(function () {


        $('.add-cart').click(function () {

            var quantity = $('.quantity-input').val();

            var color_id = $('#cart_map_id').val();

            if (color_id.length < 1) {

                swal('Add to Cart', 'Please Choose Color & Size', 'error');

            } else if (quantity < 1) {

                $('.pincode_error').html('Select Atleast 1 Quantity');

            } else {

                $('#cart_qty').val(quantity);

                $('#cartForm').submit();

                $(this).html(
                    '<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span>'
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

            e.preventDefault();

            var mrp = $(this).attr('data-mrp');
            var product_id = $(this).attr('data-product-id');
            var color_id = $(this).attr('data-color-id');
            var map_id = $(this).attr('data-map-id');
            var stock = $(this).attr('data-stock');

            if (stock <= 0) {

                $('#out_of_stock').show();
                $('#out_of_stock').html('Out Of Stock');
                $('.add-cart').attr('disabled', 'disabled');

            } else {

                $("#cart_prod_id").val(product_id);
                $("#cart_map_id").val(map_id);
                $('.mrp').html(mrp);
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.ajax({
                url: '/get-sizes',
                type: 'POST',
                data: {
                    product_id: product_id,
                    color_id: color_id,
                },
                success: function (result) {
                    var success = result.success;
                    if (success) {

                        var html = '';
                        success.forEach(data => {
                            html += `<div class="swatch-wrapper"><a class="product-size-swatch-btn variation-btn size_btn" data-toggle="tooltip"
                                        data-placement="top" title="${data.size_name}" data-size-id="${data.size_id}">
                                        <span class="product-size-swatch-label">${data.size_name}</span>
                                    </a>
                                </div>`
                        });

                        $('.product-size-swatch').html(html);
                    } else {

                    }
                }
            });

        });

        $('.size_btn').click(function () {
            console.log('clicked');

            $(this).attr('data-size-id');
        });

    });

</script>
@endsection
