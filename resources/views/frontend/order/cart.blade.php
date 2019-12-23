@extends('layouts.master')
@section('title','Cart')
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Cart</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="current"><span>Cart</span></li>
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
            @if(Cart::isEmpty())
            <div class="row">
                <div class="col-md-12 mb-50 mt-50">
                    <div class="alert alert-warning text-center">
                        <h4>Your cart is empty... You can add some product from <a href="/search">here</a></h4>
                    </div>
                </div>
            </div>
            @else

            <div class="row pt--80 pb--80 pt-md--45 pt-sm--25 pb-md--60 pb-sm--40">
                <div class="col-lg-8 mb-md--30">
                    <form class="cart-form" action="#">
                        <div class="row no-gutters">
                            <div class="col-12">
                                <div class="table-content table-responsive">
                                    <table class="table text-center">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th class="text-left">Product</th>
                                                <th>price</th>
                                                <th>quantity</th>
                                                <th>total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (Cart::getContent() as $item)

                                            <tr>
                                                <td class="product-remove text-left">
                                                    <a href="javascript:void(0)" class="btn-remove-item" data-remove-id="{{ $item->id }}">
                                                        <i class="dl-icon-close"></i>
                                                    </a>
                                                </td>

                                                <td class="product-thumbnail text-left">
                                                    <img src="{!! asset('storage/images/products/'.$item->attributes->image_url) !!} "
                                                        alt="{{ $item->name }}">
                                                </td>
                                                <td class="product-name text-left wide-column">
                                                    <h3>
                                                        <a href="{{ route('product', $item->attributes->slug_url) }}">{{ $item->name }}</a>
                                                    </h3>
                                                </td>
                                                <td class="product-price">
                                                    <span class="product-price-wrapper">
                                                        <span class="money">₹{{ $item->price }}</span>
                                                    </span>
                                                </td>
                                                <td class="product-quantity">
                                                    <div class="quantity">
                                                        <input type="number" class="quantity-input" name="qty"
                                                             value="{{ $item->quantity }}" min="1" max="{{ $item->attributes->stock }}" data-index="{{ $item->id }}" autofocus>
                                                    </div>
                                                </td>
                                                <td class="product-total-price">
                                                    <span class="product-price-wrapper">
                                                        <span class="money"><strong>₹{{ $item->price * $item->quantity }}</strong></span>
                                                    </span>
                                                </td>
                                            </tr>

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="cart-collaterals">
                        <div class="cart-totals">
                            <h5 class="mb--15">Cart totals</h5>

                            <div class="table-content table-responsive">
                                <table class="table order-table">
                                    <tbody>
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td>
                                                <span class="product-price-wrapper">
                                                    <span class="money">₹{{ Cart::getTotal() }}</span>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="{{ route('checkout') }}" class="btn btn-cls btn-fullwidth btn-style-1">
                            Proceed To Checkout
                        </a>
                        <a href="{{ route('search') }}" class="btn btn-cls btn-fullwidth btn-style-1 mt--10">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Main Content Wrapper Start -->
@endsection

@section('extrajs')
<script>

    $('.quantity-input').change(function (e) {
        console.log('clicked');

        e.preventDefault();
        var quantity = $(this).val();
        var itemid = $(this).attr('data-index');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $(this).attr('disabled', 'disabled');

        $(this).html(
            '<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span>'
        );

        $.ajax({
            url: "{{ route('cart.update') }}",
            type: 'POST',
            data: {
                quantity: quantity,
                itemid: itemid,
            },

            success: function (result) {
                var success = result.success;
                if (success) {

                    // swal('Updated Cart', 'your cart updated successfully !', 'success');

                    $('.quantity-input').removeAttr('disabled', 'disabled');

                } else {

                    // swal('Update Cart', 'Whoops Something Went Wrong !', 'error');

                    $('.quantity-input').removeAttr('disabled')
                }

                location.reload(true);

            }
        });

    });

</script>
@endsection
