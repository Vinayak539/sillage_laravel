@extends('layouts.master')
@section('title','Cart')
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area pt--70 pt-md--25">
    <div class="container">
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
                <div class="col-md-12 mb--50 mt--50">
                    <div class="alert alert-warning text-center">
                        <h4>Your cart is empty... You can add some product from <a href="{{ route('search') }}">here</a>
                        </h4>
                    </div>
                </div>
            </div>
            @else

            <div class="row pt--30 pb--80 pt-md--45 pt-sm--40 pb-md--60 pb-sm--40">
                <div class="col-md-8">
                     <!-- List group -->
                     <ul class="list-group list-group-lg list-group-flush-x mb-6">
                        @foreach (Cart::getContent() as $item)
                        <li class="list-group-item">
                          <div class="row align-items-center">
                            <div class="col-2">
          
                              <!-- Image -->
                              <a href="{{ route('product', $item->attributes->slug_url) }}">
                                <img src="{!! asset('storage/images/multi-products/'.$item->attributes->color_image) !!} "
                                alt="{{ $item->name }}" class="img-fluid">
                              </a>
          
                            </div>
                            <div class="col">
          
                              <!-- Title -->
                              <div class="d-flex mb-2 font-weight-bold">
                                <a class="text-body font-size-16px" href="{{ route('product', $item->attributes->slug_url) }}">{{ $item->name }}</a> <span class="ml-auto">₹{{ $item->price * $item->quantity }}</span>
                              </div>
          
                              <!-- Text -->
                              <p class="mb-5 font-size-15px text-muted">
                                Size: {{ $item->attributes->size_name }} <br />
                                Color: {{ $item->attributes->color_name }} <br />
                                Price : ₹{{ $item->price }}
                              </p>
          
                              <!--Footer -->
                              <div class="d-flex align-items-center">
          
                                <p class="font-size-15px">Qty. {{ $item->quantity }}</p>
          
                                <!-- Remove -->
                                <a class="font-size-15px text-gray-400 ml-auto btn-remove-item" href="javascript:void(0)" 
                                data-remove-id="{{ $item->id }}">
                                  <i class="fa fa-remove"></i> Remove
                                </a>
          
                              </div>
          
                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    
                </div>
                <div class="col-md-4">
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
                        <a href="{{ route('checkout') }}" class="btn btn-cls btn-fullwidth btn-style-1 checkout-btn">
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
    $(".checkout-btn").click(function(){
        fbq('track', 'InitiateCheckout');
    });

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