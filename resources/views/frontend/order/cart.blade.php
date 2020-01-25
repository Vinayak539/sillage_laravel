@extends('layouts.master')
@section('title','Cart')
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area pt--70 pt-md--25">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>

                    <li class="current"><span> Cart </span></li>
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
                        <h4>Your cart is empty... You can add some product from <a href="{{ route('search') }}">here</a>
                        </h4>
                    </div>
                </div>
            </div>
            @else

            <div class="row pt--30 pb--80 pt-md--45 pt-sm--25 pb-md--60 pb-sm--40">
                <div class="col-lg-8 mb-md--30">
                    <form class="cart-form" action="#">
                        <div class="row no-gutters">
                            <div class="col-12">
                                <div class="table-content table-responsive">
                                    <table class="table text-center">
                                        <thead style="background-color: #f2f2f2;">
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th class="text-left">Product</th>
                                                <th class="text-left">Colour & Size</th>
                                                <th>price</th>
                                                <th>quantity</th>
                                                <th>total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (Cart::getContent() as $item)
                                            <tr>
                                                <td class="product-remove text-left">
                                                    <a href="javascript:void(0)" class="btn-remove-item"
                                                        data-remove-id="{{ $item->id }}">
                                                        <i class="fa fa-times" aria-hidden="true"></i></i>
                                                    </a>
                                                </td>

                                                <td class="product-thumbnail text-left">
                                                    <img src="{!! asset('storage/images/products/'.$item->attributes->image_url) !!} "
                                                        alt="{{ $item->name }}">
                                                </td>
                                                <td class="product-name text-left wide-column">
                                                    <h3>
                                                        <a href="{{ route('product', $item->attributes->slug_url) }}">{{ $item->name }}
                                                        </a>
                                                    </h3>
                                                </td>
                                                <td class="product-price text-left">
                                                    <span class="product-price-wrapper">
                                                        <span class="money">{{ $item->attributes->color_name }} &
                                                            {{ $item->attributes->size_name }}</span>
                                                    </span>
                                                </td>
                                                <td class="product-price">
                                                    <span class="product-price-wrapper">
                                                        <span class="money">₹{{ $item->price }}</span>
                                                    </span>
                                                </td>
                                                <td class="product-quantity">
                                                    <ul class="order-box">
                                                        <li>
                                                            <div class="value-decrease switcher">-</div>
                                                        </li>
                                                        <li><input type="number" min="1" max="22" value="1" disabled
                                                                class="product-value val"></li>
                                                        <li>
                                                            <div class="value-increase switcher">+ </div>
                                                            <input type="number" min="1" max="22" value="{{ $item->quantity }}" disabled
                                                                class="product-value val">
                                                        </li>
                                                    </ul>
                                                    <!-- <div class="quantity">
                                                        <input type="number" class="quantity-input" name="qty"
                                                            value="{{ $item->quantity }}" min="1"
                                                            max="{{ $item->attributes->stock }}"
                                                            data-index="{{ $item->id }}"
                                                            data-stock="{{ $item->attributes->stock }}" autofocus>
                                                    </div> -->
                                                </td>
                                                <td class="product-total-price">
                                                    <span class="product-price-wrapper">
                                                        <span
                                                            class="money"><strong>₹{{ $item->price * $item->quantity }}</strong></span>
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
    if ($(".product-value").length) {
            $('.value-increase').on('click',function(){
              var $qty=$(this).closest('ul').find('.product-value');
              var currentVal = parseInt($qty.val());
              if (!isNaN(currentVal)) {
                  $qty.val(currentVal + 1);
              }
          });
          $('.value-decrease').on('click',function(){
              var $qty=$(this).closest('ul').find('.product-value');
              var currentVal = parseInt($qty.val());
              if (!isNaN(currentVal) && currentVal > 1) {
                  $qty.val(currentVal - 1);
              }
          });
        }
    $('.quantity-input').change(function (e) {
        e.preventDefault();

        var quantity = parseInt($(this).val());
        var itemid = $(this).attr('data-index');
        var stock = parseInt($(this).attr('data-stock'));

        if (quantity > stock) {
            swal('Out Of Stock', 'Product is Currently Out of Stock, Stay Tuned !', 'error');
        } else {
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

                    console.log('size', result.size);
                    if (success) {

                        $('.quantity-input').removeAttr('disabled', 'disabled');

                    } else {

                        $('.quantity-input').removeAttr('disabled')
                    }

                    location.reload(true);

                }
            });
        }

    });

</script>
@endsection