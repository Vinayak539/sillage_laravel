@extends('layouts.master')
@section('title','Checkout')
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area bg--white-6 pt--60 pb--70 pt-lg--40 pb-lg--50 pt-md--30 pb-md--40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Checkout</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li class="current"><span>Checkout</span></li>
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
            <!-- <div class="row pt--80 pt-md--60 pt-sm--40"> -->
            <div class="row pt--40 pb--80 pb-md--60 pb-sm--40">
                <!-- Checkout Area Start -->
                @if(auth('user')->check())
                <div class="col-lg-6">
                    <div class="checkout-title mt--10">
                        <h2>Billing Details</h2>
                    </div>
                    <form action="{{ route('order.checkout') }}" method="POST" class="form form--checkout"
                        id="formCheckout">
                        @csrf

                        <div class="checkout-form">

                            <div class="form-row mb--30">
                                <div class="form__group col-md-12 mb-sm--30">
                                    <label for="name" class="form__label form__label--2">Name
                                        <span class="required">*</span></label>
                                    <input type="text" name="name" id="name" class="form__input form__input--2" required
                                        placeholder="Name" value="{{ auth('user')->user()->name }}">
                                </div>
                            </div>
                            @if(auth('user')->user()->mobile)
                            <input type="hidden" name="mobile" value="{{ auth('user')->user()->mobile }}" min="0"
                                minlength="10" maxlength="10">
                            @else
                            <div class="form-row mb--30">
                                <div class="form__group col-12">
                                    <label for="mobile" class="form__label form__label--2">Phone <span
                                            class="required">*</span></label>
                                    <input type="text" name="mobile" id="mobile" class="form__input form__input--2"
                                        required placeholder="Mobile Number" required>
                                </div>
                            </div>
                            @endif

                            <div class="form-row mb--30">
                                <div class="form__group col-12">
                                    <label for="email" class="form__label form__label--2">Email Address
                                        <span class="required">*</span></label>
                                    <input type="email" name="email" id="email" class="form__input form__input--2"
                                        value="{{ auth('user')->user()->email }}" placeholder="Email Address" required>
                                </div>
                            </div>

                            <div class="form-row mb--30">
                                <div class="form__group col-12">
                                    <label for="country" class="form__label form__label--2">Country
                                        <span class="required">*</span></label>
                                    <select id="country" name="country" class="form__input form__input--2 nice-select"
                                        required>
                                        <option value="">Select a country…</option>
                                        <option value="India" selected>India</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row mb--30">
                                <div class="form__group col-12">
                                    <label for="address" class="form__label form__label--2">Street
                                        Address <span class="required">*</span></label>

                                    <input type="text" name="address" id="address"
                                        class="form__input form__input--2 mb--30"
                                        placeholder="House number and street name" required
                                        value="{{ auth('user')->user()->address }}" required>
                                </div>
                            </div>

                            <div class="form-row mb--30">
                                <div class="form__group col-12">
                                    <label for="landmark" class="form__label form__label--2">Landmark</label>
                                    <input type="text" name="landmark" id="landmark" class="form__input form__input--2"
                                        placeholder="Landmark" value="{{ auth('user')->user()->landmark }}">
                                </div>
                            </div>

                            <div class="form-row mb--30">
                                <div class="form__group col-12">
                                    <label for="city" class="form__label form__label--2">Town / City
                                        <span class="required">*</span></label>
                                    <input type="text" name="city" id="city" class="form__input form__input--2" required
                                        placeholder="Town/City" value="{{ auth('user')->user()->city }}" required>
                                </div>
                            </div>

                            <div class="form-row mb--30">
                                <div class="form__group col-12">
                                    <label for="territory" class="form__label form__label--2">State
                                        <span class="required">*</span></label>
                                    <input type="text" name="territory" id="territory"
                                        class="form__input form__input--2" required placeholder="State"
                                        value="{{ auth('user')->user()->territory }}" required>
                                </div>
                            </div>

                            <div class="form-row mb--30">
                                <div class="form__group col-12 check">
                                    <div class="input-group">
                                        <label for="pincode" class="form__label form__label--2">Pincode
                                            <span class="required">*</span></label>
                                        <input type="text" name="pincode" id="pincode"
                                            class="form__input form__input--2" required placeholder="pincode"
                                            value="{{ Session::get('pincode') }}" required>
                                        <div class="input-group-append">
                                            <button type="button"
                                                class="check-availibility pincode_button theme-button-three  mr-0">
                                                Check
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mb--30">
                                <div class="pincode-check form__group col-12">
                                    <p class="text-success pincode_success"></p>
                                    <p class="text-danger pincode_error"></p>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-6 mt-md--40">
                    <div class="order-details">
                        <div class="checkout-title mt--10">
                            <h2>Your Order</h2>
                        </div>
                        <div class="table-content table-responsive mb--30">
                            <table class="table order-table order-table-2">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::getContent() as $item)
                                    <tr>
                                        <th>{{ $item->name }}
                                            <strong><span>&#10005;</span>{{ $item->quantity }}</strong>
                                        </th>
                                        <td class="text-right">₹{{ $item->price }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td class="text-right">₹{{ Cart::getTotal() }}</td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Shipping</th>
                                        <td class="text-right">
                                            <span> ₹60</span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td class="text-right"><span
                                                class="order-total-ammount">₹{{ Cart::gettotal() + 60 }}</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="checkout-payment">
                            <div class="payment-group mb--10">
                                <div class="payment-radio">
                                    <input type="radio" value="paytm" name="payment_mode" id="paytm" checked>
                                    <label class="payment-label" for="paytm">DEBIT/CREDIT/NETBANKING/PAYTM</label>
                                </div>
                            </div>

                            <div class="payment-group mb--10">
                                <!-- <div class="payment-radio">
                                    <input type="radio" value="cod" name="payment_mode" id="cod">
                                    <label class="payment-label" for="cod">
                                        CASH ON DELIVERY
                                    </label>
                                </div> -->
                                <div class="payment-info cash hide-in-default" data-method="cash">
                                    <p>Pay with cash upon delivery.</p>
                                </div>
                                <div class="promocode-checkout">
                                    <div class="faq-tab-wrapper-three">
                                        <div class="faq-panel">
                                            <div class="panel-group theme-accordion" id="accordion">
                                                <div class="panel">
                                                    <div class="panel-heading active-panel">
                                                        <h6 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion"
                                                                href="#collapse1">
                                                                Enter Promo Code</a>
                                                        </h6>
                                                    </div>
                                                    <div id="collapse1" class="panel-collapse collapse show">
                                                        <div class="panel-body">
                                                            <div class="check">
                                                                <div class="input-group">
                                                                    <input type="text" name="promocode" id="promocode"
                                                                        class="single-input-wrapper check-availibility promocode"
                                                                        placeholder="enter code here!"
                                                                        style="border-right: none;margin-bottom: 0;">
                                                                    <div class="input-group-append">
                                                                        <button type="button"
                                                                            class="verify_promo check-availibility theme-button-three  mr-0">
                                                                            Apply
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <input id="promocode" type="text"
                                                                    name="promocode" class="promocode"
                                                                    placeholder="enter code here!">
                                                            </div> -->
                                                            <div class="acType-content mt-10">
                                                                <ul class="acType-list">
                                                                    @foreach($promocodes as $promo)
                                                                    <li>
                                                                        <div>
                                                                            <input type="radio" name="promo"
                                                                                class="promo"
                                                                                value="{{ $promo->promocode }}">
                                                                            <label
                                                                                for="{{ $promo->promocode }}">{{ $promo->promocode }}</label>
                                                                        </div>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel">
                                                    <div class="panel-heading">
                                                        <h6 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion"
                                                                href="#collapse2">
                                                                Enter Shop Name!</a>
                                                        </h6>
                                                    </div>
                                                    <div id="collapse2" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="check">
                                                                <div class="input-group">
                                                                    <input type="text" name="discountcode"
                                                                        id="discountcode"
                                                                        class="single-input-wrapper check-availibility discountcode"
                                                                        placeholder="Enter Shop Name"
                                                                        style="border-right: none;margin-bottom: 0;">
                                                                    <div class="input-group-append">
                                                                        <button type="button"
                                                                            class="verify_promo check-availibility theme-button-three  mr-0">
                                                                            Apply
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <div class="promo_success text-success mt-3"></div>
                                            <div class="promo_error text-danger mt-3"></div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="payment-group mt--20">
                                <p class="mb--15">Your personal data will be used to process your order,
                                    support your experience throughout this website, and for other purposes
                                    described in our privacy policy.</p>
                                <button type="submit" class="btn btn-fullwidth btn-style-1 order_place">Place
                                    Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                @else
                <!-- Checkout Area End -->
                <div class="Checkout_section mt-32">
                    <div class="container">
                        <div class="checkout_form">

                            <div class="row">
                                <div class="col-md-6 sm-mb-50">
                                    <div class="signUp-page signUp-minimal">
                                        <div class="signin-form-wrapper">
                                            <div class="title-area text-center">
                                                <h3>Login.</h3>
                                            </div> <!-- /.title-area -->
                                            <form id="login-form" action="{{ route('user.login') }}" method="POST"
                                                autocomplete="off" class="login">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <input type="text" name="email" value="" required>
                                                            <label>Email *</label>
                                                        </div> <!-- /.input-group -->
                                                    </div> <!-- /.col- -->
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <input type="password" name="password" required>
                                                            <label>Password *</label>
                                                        </div> <!-- /.input-group -->
                                                    </div> <!-- /.col- -->
                                                </div> <!-- /.row -->
                                                <div
                                                    class="agreement-checkbox d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <input type="checkbox" name="remember" checked id="remember">
                                                        <label for="remember">Remember Me</label>
                                                    </div>
                                                    <a href="https://thehatkestore.com/myaccount/password/email">Forget
                                                        Password?</a>
                                                </div>
                                                <button type="submit"
                                                    class="line-button-one button-rose button_update_login">Login</button>
                                            </form>
                                            <p class="signUp-text text-center">
                                                <a href="{{ route('user.login.otp') }}">Or Login With Otp</a>
                                            </p>
                                            <p class="or-text"><span>or</span></p>
                                            <ul class="social-icon-wrapper row">
                                                <li class="col-12"><a href="/auth/google" class="gmail"><i
                                                            class="fa fa-envelope-o" aria-hidden="true"></i>
                                                        Gmail</a></li>
                                                <!-- <li class="col-12"><a href="/auth/facebook" class="gmail"><i
                                                            class="fa fa-facebook" aria-hidden="true"></i>
                                                        Facebook</a></li> -->

                                            </ul>
                                        </div> <!-- /.sign-up-form-wrapper -->
                                    </div> <!-- /.signUp-page -->
                                </div>

                                <div class="col-md-6">
                                    <div class="login-or">
                                        <h3>OR</h3>
                                    </div>
                                    <div class="signUp-page signUp-minimal">
                                        <div class="signin-form-wrapper">
                                            <div class="title-area text-center">
                                                <h3>Register.</h3>
                                            </div> <!-- /.title-area -->
                                            <form action="{{ route('user.register') }}" method="POST" autocomplete="off"
                                                class="register">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <input type="text" name="name" value="" required>
                                                            <label>Name *</label>
                                                        </div> <!-- /.input-group -->
                                                    </div> <!-- /.col- -->
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <input type="text" name="mobile" value="" required>
                                                            <label>Mobile Number *</label>
                                                        </div> <!-- /.input-group -->
                                                    </div> <!-- /.col- -->
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <input type="text" name="email" value="" required>
                                                            <label>Email *</label>
                                                        </div> <!-- /.input-group -->
                                                    </div> <!-- /.col- -->
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <input type="password" name="password" required>
                                                            <label>Password *</label>
                                                        </div> <!-- /.input-group -->
                                                    </div> <!-- /.col- -->
                                                </div> <!-- /.row -->
                                                <button type="submit"
                                                    class="line-button-one button-rose button_update_register">Register</button>
                                            </form>

                                        </div> <!-- /.sign-up-form-wrapper -->
                                    </div> <!-- /.signUp-page -->
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Main Content Wrapper Start -->

@endsection

@section('extracss')
<style>
    .error {
        color: rgb(238, 53, 53);
    }

</style>
@endsection

@section('extrajs')

<script>
    $(document).ready(function () {

        $('.order_place').attr('disabled', 'disabled');
        $('.order_place').addClass('isDisabled'); //Use for styling place order button

        var pincode = $('#pincode').val();

        chkPindode(pincode);

        $('.pincode_button').click(function () {
            var val = $('#pincode').val();
            if (val == '') {
                $('#pincode').focus();
                $('.pincode_error').html('Please Enter Pincode');
                $('.pincode_button').html('<i class="fa fa-search" aria-hidden="true"></i>');
                $('.pincode_button').removeAttr('disabled', 'disabled');
            } else if (val.length == 6) {

                chkPindode(val);

            } else {

                $('.pincode_error').html('Pincode should be of 6 digits');
            }
        });

        $("#formCheckout").validate({
            rules: {

                name: {
                    required: true
                },

                email: {
                    required: true,
                    email: true
                },

                country: {
                    required: true,
                },

                address: {
                    required: true,
                },

                city: {
                    required: true,
                },

                territory: {
                    required: true,
                },

                pincode: {
                    required: true,
                    minlength: 6,
                    maxlength: 6
                },
            },
            messages: {

                name: {
                    required: "Please Enter Name"
                },

                email: {
                    required: "Please Enter Email",
                    email: "Please Enter Proper Email ID"
                },

                country: {
                    required: "Please Select Country"
                },

                address: {
                    required: "Please Enter Address"
                },

                city: {
                    required: "Please Enter City"
                },

                territory: {
                    required: "Please Enter Territory"
                },

                pincode: {
                    required: "Please Enter Pincode",
                    minlength: "Pincode should be of 6 digits",
                    maxlength: "Pincode should be of 6 digits",
                },

            },
            submitHandler: function (form) {
                $('.order_place').attr('disabled', 'disabled');
                $(".order_place").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });

        $('.verify_promo').click(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });
            $(this).html('Wait...');
            $(this).attr('disabled', 'disabled');
            $.ajax({
                url: "{{ route('verify.promocode') }}",
                method: 'POST',
                data: {
                    promocode: $('.promocode').val(),
                    discountcode: $('#discountcode').val(),
                },
                success: function (result) {
                    if (result.success) {
                        $('.promo_success').html(result.success);
                        $('.verify_promo').html('Apply');
                        $('.verify_promo').removeAttr('disabled', 'disabled');
                        $('.promo_error').hide();
                        $('.promo_success').show();
                        setTimeout(function () {
                            $('.promo_success').fadeOut();
                        }, 4000);
                    } else {
                        $('.promo_success').hide();
                        $('.promo_error').show();
                        $('.promo_error').html(result.error);
                        $('.verify_promo').html('Apply');
                        $('.verify_promo').removeAttr('disabled', 'disabled');
                        setTimeout(function () {
                            $('.promo_error').fadeOut();
                        }, 4000);
                    }
                }
            });
        });

    });

    function chkPindode(val) {
        if (val == '') {
            $('#pincode').focus();
            $('.pincode_error').html('Please Enter Pincode');
            $('.pincode_button').html('<i class="fa fa-search" aria-hidden="true"></i>');
            $('.pincode_button').removeAttr('disabled', 'disabled');
        } else if (val.length == 6) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });
            $('.pincode_button').html('Wait...');
            $('.pincode_button').attr('disabled', 'disabled');
            $.ajax({
                url: '/pincode',
                type: 'POST',
                data: {
                    pincode: val,
                },
                success: function (result) {
                    if (result.error) {
                        $('.pincode_error').html(result.error);
                        $('.pincode_success').css('display', 'none');
                        $('.pincode_error').css('display', 'block');
                        $('.pincode_button').html('<i class="fa fa-search" aria-hidden="true"></i>');
                        $('.pincode_button').removeAttr('disabled', 'disabled');
                    } else {
                        $('.pincode_success').html(result.success);
                        $('.pincode_error').css('display', 'none');
                        $('.pincode_success').css('display', 'block');
                        $('.pincode_button').html('<i class="fa fa-search" aria-hidden="true"></i>');
                        $('.pincode_button').removeAttr('disabled', 'disabled');
                        $('.order_place').prop('disabled', false);
                        $('.order_place').removeClass('isDisable');
                    }
                }
            });
        } else {

            $('.pincode_error').html('Pincode should be of 6 digits');
        }
    }

</script>
@endsection
