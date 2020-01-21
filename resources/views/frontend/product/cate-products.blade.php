@extends('layouts.master')
@section('title') {{ $category->name }} @endsection
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area pt--70 pt-md--25">
    <div class="container-fluid">
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
        <div class="container-fluid">
            <div class="row shop-fullwidth pt--45 pt-md--35 pt-sm--20 pb--60 pb-md--50 pb-sm--40">
                <div class="col-12">
                    {{-- <div class="shop-toolbar">
                            <div class="shop-toolbar__inner">
                                <div class="row align-items-center">
                                    <div class="col-md-6 text-md-left text-center mb-sm--20">
                                        <div class="shop-toolbar__left">
                                            <p class="product-pages">Showing {{count($products)}} results</p>
                </div>
            </div>
            <div class="col-md-6">
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
            </div>
        </div>
    </div>
    <div class="advanced-product-filters">
        <div class="product-filter">
            <div class="row">

                <div class="col-md-3">
                    <div class="product-widget product-widget--brand">
                        <h3 class="widget-title">Brands</h3>
                        <ul class="product-widget__list">
                            @foreach($brands as $brand)
                            <li>
                                <input type="checkbox" id="{{ $brand->brand_name.$brand->id }}" name="brands[]"
                                    value="{{ $brand->id }}" class="cb_brands filter"
                                    data-cate-id="{{ $category->id }}">
                                <a href="javascript:void(0)">
                                    <label for="{{ $brand->brand_name.$brand->id }}">
                                        <span>{{ $brand->brand_name }}</span></label>
                                </a>
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
                                <input type="checkbox" id="{{ $cond->condition.$cond->id }}" name="conditions[]"
                                    value="{{ $cond->id }}" class="cb_conditions filter">
                                <a href="javascript:void(0)">
                                    <label for="{{ $cond->condition.$cond->id }}">
                                        <span>{{ $cond->condition }}</span></label>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
            <a href="#" class="btn-close"><i class="fa fa-times" aria-hidden="true"></i></i></a>
        </div>
    </div>
</div> --}}

<div class="shop-products">
    <div class="row grid-space-20 xxl-block-grid-5">
        @forelse($products as $product)
        <div class="col-lg-3 col-sm-6 mb--40 mb-md--30">
            <div class="airi-product">
                <div class="product-inner">
                    <figure class="product-image">
                        <div class="product-image--holder">
                            <a href="{{ route('product',[$product->slug_url]) }}">

                                <img alt="Product Image" class="primary-image lazy"
                                    data-original="{!! asset('storage/images/products/' .$product->image_url) !!}">

                                <img alt="Product Image" class="secondary-image lazy"
                                    data-original="{!! asset('storage/images/products/' .$product->image_url1) !!}">
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

@endsection
{{--
@section('extrajs')

<script>
    $(document).ready(function () {
        $('.filter').click(function () {
            getProducts();
        });
    });

    function getProducts() {
        var brand_lists = [];
        var condition_lists = [];
        var category_id = $('.cb_brands').attr('data-cate-id');
        $(".cb_brands:checked").each(function () {
            brand_lists.push($(this).val());
        });
        $(".cb_conditions:checked").each(function () {
            condition_lists.push($(this).val());
        });
        $.ajax({
            url: "{{ route('categories.filter') }}",
type: 'GET',
data: {
brands: brand_lists,
conditions: condition_lists,
category_id: category_id,
},
success: function (result) {
var html = '';

result.products.data.forEach(product => {

html = html + `
<div class="col-lg-3 col-sm-6 mb--40 mb-md--30">
    <div class="airi-product">
        <div class="product-inner">
            <figure class="product-image">
                <div class="product-image--holder">
                    <a href="{{ route('product',[$product->slug_url]) }}">

                        <img src="{!! asset('storage/images/products').'/'.$product->image_url !!}" alt="Product Image"
                            class="primary-image">

                        <img src="{!! asset('storage/images/products').'/'.$product->image_url1 !!}" alt="Product Image"
                            class="secondary-image">
                    </a>
                </div>
            </figure>
            <div class="product-info">
                <h3 class="product-title">
                    <a href="{{ route('product',[$product->slug_url]) }}">{{ Str::limit($product->title,15) }}</a>
                    <span class="pull-right">
                        ${getFilledRating(product.rating)}
                        ${getEmptyRating(product.rating)}
                    </span>
                </h3>
            </div>
        </div>
    </div>
</div>
`;
});
$('.airi-product').html(html);
}


});
}

function getFilledRating(rating) {
var ratingData = '';
for (i = 1; i <= rating; i++) { ratingData=ratingData + `<li>
    <a href="javascript:void(0)"><i class="fa fa-star"></i></a>
    </li>`;
    }
    return ratingData;
    }

    function getEmptyRating(rating) {
    var ratingData = '';
    for (i = 1; i <= 5 - rating; i++) { ratingData=ratingData + `<li>
        <a href="javascript:void(0)"><i class="fa fa-star-o"></i></a>
        </li>`;
        }
        return ratingData;
        }

        </script>

        @endsection --}}