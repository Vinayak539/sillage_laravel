@extends('layouts.master')
@section('title', 'Search')
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area pt--70 pt-md--25">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>
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
                    <div class="shop-toolbar">
                        <div class="shop-toolbar__inner">
                            <div class="row align-items-center">
                                <div class="col-md-6 text-md-left text-center mb-sm--20">
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
                                </div>  --}}
                            </div>
                        </div>
                        {{-- <div class="advanced-product-filters">
                            <div class="product-filter">
                                <form action="{{ route('search.filter') }}" method="get">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="product-widget product-widget--brand">
                                                <h3 class="widget-title">Brands</h3>
                                                <ul class="product-widget__list">
                                                    @foreach($brands as $brand)
                                                    <li>
                                                        <input type="checkbox" id="{{ $brand->brand_name.$brand->id }}"
                                                            name="brands[]" value="{{ $brand->id }}"
                                                            class="cb_brands filter" >
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
                                                        <input type="checkbox" id="{{ $cond->condition.$cond->id }}"
                                                            name="conditions[]" value="{{ $cond->id }}"
                                                            class="cb_conditions filter">
                                                        <a href="javascript:void(0)">
                                                            <label for="{{ $cond->condition.$cond->id }}">
                                                                <span>{{ $cond->condition }}</span></label>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
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
                                            <h3 class="product-title text-center">
                                                <a href="{{ route('product',[$product->slug_url]) }}">
                                                    {{ $product->title }}
                                                </a>

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
@section('extrajs')
<script>
    $(document).ready(function () {

        fbq('track', 'ViewContent', { content_name: 'Search Page' });
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
