@extends('layouts.master')
@section('title') {{ $category->name }} @endsection
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area pt--70 pt-md--25">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>

                    <li class="current"><span> {{ $category->name }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb area End -->

<!-- Main Content Wrapper Start -->
<div id="content" class="main-content-wrapper">
    <div class="shop-page-wrapper">
        <div class="container">
            <div class="row shop-fullwidth pb--60 pb-md--50 pb-sm--40">
                <div class="col-12">
                    <div class="shop-toolbar">
                        <div class="shop-toolbar__inner">
                            <div class="row">
                                <div class="col-md-6">
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
                                        
                                    </div> 
                                </div>--}}
                            </div>
                        </div>
                        {{-- <div class="advanced-product-filters">
                            <div class="product-filter">
                                <form action="{{ route('categories.filter') }}" method="get">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="product-widget product-widget--brand">
                                                <h3 class="widget-title">Brands</h3>
                                                <ul class="product-widget__list">
                                                    @foreach($brands as $brand)
                                                    <li>
                                                        <label for="{{ $brand->brand_name.$brand->id }}" class="cb-container">{{ $brand->brand_name }}
                                                            <input type="checkbox" id="{{ $brand->brand_name.$brand->id }}"
                                                            name="brands[]" value="{{ $brand->id }}"
                                                            class="cb_brands filter" data-cate-id="{{ $category->id }}">
                                                            <span class="cb-checkmark"></span>
                                                        </label>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="product-widget product-widget--color">
                                                <h3 class="widget-title">Conditions</h3>
                                                <ul class="product-widget__list product-color-swatch">
                                                    @foreach($conditions as $cond)
                                                    <li>
                                                        <label for="{{ $cond->condition.$cond->id }}" class="cb-container">
                                                            {{ $cond->condition }}
                                                            <input type="checkbox" id="{{ $cond->condition.$cond->id }}"
                                                            name="conditions[]" value="{{ $cond->id }}"
                                                            class="cb_conditions filter">
                                                            <span class="cb-checkmark"></span>
                                                        </label>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                                        <div class="col-md-3">
                                            <button type="submit">
                                                Filter
                                            </button>
                                        </div>
                                    </div>
                                    <a href="#" class="btn-close"><i class="fa fa-times" aria-hidden="true"></i></i></a>
                                </form>
                            </div>
                        </div> --}}
                    </div>

                    <div class="shop-products">
                        <div class="row grid-space-20 xxl-block-grid-5">
                            @forelse($products as $product)
                            <div class="col-lg-3 col-sm-6 col-6 mb--40 mb-md--30">
                                <div class="airi-product">
                                    <div class="product-inner">
                                        <figure class="product-image">
                                            <div class="product-image--holder">
                                                <a href="{{ route('product',[$product->slug_url]) }}">

                                                    <img alt="Product Image" class="primary-image lazy"
                                                        data-src="{!! asset('storage/images/products/' .$product->image_url) !!}">

                                                    <img alt="Product Image" class="secondary-image lazy"
                                                        data-src="{!! asset('storage/images/products/' .$product->image_url1) !!}">
                                                </a>
                                            </div>
                                            <span class="product-trending">Trending</span>
                                            <span class="product-badge fav"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
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
                                                <a
                                                    href="{{ route('product',$product->slug_url) }}">{{ $product->title }}</a>
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
                                                    @for($i=0; $i < 4; $i++)
                                                        <span style="background: {{ $colors[$i] }};border-radius:50%;height:10px;width:10px;display:inline-block;box-shadow: 1px 2px 3px 0px #5f5f5f"></span>
                                                    @endfor
                                                </span>
                                            @else
                                            <span class="pull-right">
                                                @foreach($colors as $color)
                                                    <span style="background: {{ $color }};border-radius:50%;height:10px;width:10px;display:inline-block;box-shadow: 1px 2px 3px 0px #5f5f5f"></span>
                                                @endforeach
                                            </span>
                                            @endif
                                            @endif
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
                        {{ $products->links() }}
                    </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content Wrapper Start -->

@endsection @section('extracss')
<style>
    .product-title a {
    /* color: #fff; */
    color: #282828;
}
</style>
@endsection
@section('extrajs')
<script>
    $(document).ready(function () {

        fbq('track', 'ViewContent', { content_name: '{{ $category->name }}' });
        $('#reset').click(function () {
            window.location.href = '/artist?q=';
            return false;
        });
    });

</script>
<script>
    $(document).ready(function () {
        var old_brands = {!! json_encode($input->brands) !!};
        if (old_brands && typeof old_brands == "object") {
            for (x of old_brands) {
                $(".cb_brands[value=" + x + "]").attr("checked", "checked");
            }
        }
        var old_conditions = {!! json_encode($input->conditions) !!};
        if (old_conditions && typeof old_conditions == "object") {
            for (x of old_conditions) {
                $(".cb_conditions[value=" + x + "]").attr("checked", "checked");
            }
        }
    });

</script>
@endsection
