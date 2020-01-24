@extends('layouts.master')
@section('title','Checkout')
@section('content')

<!-- Breadcrumb area Start -->
<div class="breadcrumb-area pt--70 pt-md--25">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <ul class="breadcrumb">
                    <li><a href="{{ route('index') }}">Home</a></li>

                    <li class="current"><span> Checkout </span></li>
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
                
                    <div class="col-md-12">
                        <form action="{{ route('order.checkout') }}" method="post" id="formCheckout">
                            @csrf
                            <div class="row">
            
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkout-title mt--10">
                                                <h2>Select Delivery Address</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="checkout-form form-row mb--30">
                                                <div class="form__group col-md-6 mb-sm--30">
                                                    <div class="pincode-deliveryContainer">
                                                        <label for="name" style="padding-left: 0;" class="form__label form__label--2">Please enter
                                                            PIN code to check delivery
                                                            <span class="required">*</span></label>
                                                        <input type="text" placeholder="Enter pincode"
                                                            class="pincode-code form__input form__input--2 valid"
                                                            value="{{ Session::get('pincode') }}" name="pincode"
                                                            id="pincode" required style="width: 290px">
                                                        <button type="button"
                                                            class="pincode-check pincode-button check-availibility pincode_button">
                                                            <i class="fa fa-search" aria-hidden="true"></i></button>
                                                    </div>
                                                </div>
                                                <div class="form__group col-md-6 mt--40 pincd">
                                                    <label for="pincode" class="error pincode_error"></label>
                                                    <p class="text-success pincode_success"></p>
                                                    <!-- <p class="text-danger pincode_error"></p> -->
                                                </div>
                                            </div>
                                        </div>

                                        @foreach($addresses as $add)
                                        <div class="col-md-6">
                                            <label class="radio-cont">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title pl--35">

                                                            {{ $add->name }}

                                                            <input type="radio" checked="checked" name="choose_address"
                                                                value="{{ $add->id }}" data-pincode="{{ $add->pincode }}">
                                                            <span class="checkmark"></span>

                                                            <b><span class="badge badge-pill badge-primary" style="font-size: 12px;float:right;margin-top:6px">{{ $add->type_of_address ? 'Work' : 'Home' }}</span></b>
                                                        </h4>
                                                        <p class="card-text">
                                                            {{ $add->address }},
                                                            {{ $add->landmark }},
                                                            {{ $add->city }},
                                                            {{ $add->territory }},
                                                            {{ $add->country }},
                                                            {{ $add->pincode }},
                                                        </p>
                                                        @if($add->mobile)
                                                        <p class="text-info"> 
                                                            {{ $add->mobile }}
                                                        </p>
                                                        @else
                                                        <p class="text-danger">
                                                            Update Mobile Number
                                                        </p>
                                                        @endif
                                                        
                                                    </div>
                                                    <div class="card-footer">
                                                        <a href="javascript:void(0)"
                                                            class="card-link float-left remove-address"
                                                            data-obj-id="{{ $add->id }}">Remove</a>
                                                        <a href="javascript:void(0)" data-obj-id="{{ $add->id }}"
                                                            class="card-link float-right editAddress">Edit</a>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        @endforeach

                                        <div class="col-md-6 add_address">
                                            <label class="radio-cont" data-toggle="modal" data-target="#new-address">
                                                <div class="card">
                                                    <div class="card-body text-center pt--130" style="height: 334px;">
                                                        <i class="fa fa-plus-circle text-black"></i>
                                                        <p class="text-black"> Add new address</p>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-lg-4 mt-md--40">
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
                                                    @php
                                                    $isCodAvailable = true;
                                                    @endphp
                                                    @foreach (Cart::getContent() as $item)
                                                    <tr>
                                                        <th>{{ $item->name }}
                                                            <strong><span>&#10005;</span>{{ $item->quantity }}</strong>
                                                        </th>
                                                        <td class="text-right">₹{{ $item->price }}</td>
                                                    </tr>
                                                    @php
                                                    $isCodAvailable = $item->attributes->isCodAvailable && $isCodAvailable;
                                                    @endphp
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
                                            
                                            <div class="promocode-checkout">
                                                <div class="faq-tab-wrapper-three">
                                                    <div class="faq-panel">
                                                        <div class="panel-group theme-accordion" id="accordion">
                                                            <div class="panel">
                                                                <div class="panel-heading"  id="heading1">
                                                                    <h6 class="panel-title">
                                                                        <a data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                                            Enter Promo Code</a>
                                                                    </h6>
                                                                </div>
                                                                <div id="collapse1" class="panel-collapse collapse show" aria-labelledby="heading1"  data-parent="#accordion">
                                                                    <div class="panel-body">
                                                                        <div class="check">
                                                                            <div class="input-group">
                                                                                <input type="text" name="promocode"
                                                                                    id="promocode"
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
                                                                <div class="panel-heading"  id="heading2">
                                                                    <h6 class="panel-title">
                                                                        <a class="collapsed" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                                            Enter Shop Code!</a>
                                                                    </h6>
                                                                </div>
                                                                <div id="collapse2" class="panel-collapse collapse" aria-labelledby="heading2" data-parent="#accordion">
                                                                    <div class="panel-body">
                                                                        <div class="check">
                                                                            <div class="input-group">
                                                                                <input type="text" name="discountcode"
                                                                                    id="discountcode"
                                                                                    class="single-input-wrapper check-availibility discountcode"
                                                                                    placeholder="Enter Shop Code"
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

                                            <div class="payment-group mb--10">
                                                <div class="payment-radio">
                                                    <label for="paytm" class="cb-container">
                                                        DEBIT/CREDIT/NETBANKING/PAYTM
                                                        <input type="radio" value="paytm" name="payment_mode" id="paytm"
                                                        checked>
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            @if($isCodAvailable)
                                            <div class="payment-group mb--10">
                                                <div class="payment-radio">
                                                    <label for="cod" class="cb-container">
                                                        CASH ON DELIVERY
                                                        <input type="radio" value="cod" name="payment_mode" id="cod">
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            @endif


                                            <div class="payment-group mt--20">
                                                @if(count($addresses))
                                                <button type="submit" class="btn btn-fullwidth btn-style-1 order_place">
                                                    Place Order
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                
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
                                                <h3>Login</h3>
                                            </div> <!-- /.title-area -->
                                            <form id="login-form" action="{{ route('user.login') }}" method="POST"
                                                autocomplete="off" class="login needs-validation">
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
                                                    <a href="{{ route('user.password.request') }}">Forget
                                                        Password?</a>
                                                </div>
                                                <button type="submit"
                                                    class="line-button-one button-rose button_update_login">
                                                    Login
                                                </button>
                                            </form>
                                            <p class="signUp-text text-center">
                                                <a href="{{ route('user.login.otp') }}">Or Login With Otp</a>
                                            </p>
                                            <p class="or-text"><span>or</span></p>
                                            <ul class="social-icon-wrapper row">
                                                <li class="col-12"><a
                                                        href="{{ route('user.auth.socialite', 'google') }}"
                                                        class="gmail"><i class="fa fa-envelope-o"
                                                            aria-hidden="true"></i>
                                                        Gmail</a></li>
                                                <li class="col-12"><a href="#" class="facebook"><i
                                                            class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                                                </li>
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
                                                <h3>Register</h3>
                                            </div> <!-- /.title-area -->
                                            <form action="{{ route('user.register') }}" method="POST" autocomplete="off"
                                                class="register needs-validation" id="formRegister">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <input type="text" name="name" value="{{ old('name') }}"
                                                                required>
                                                            <label>Name *</label>
                                                        </div> <!-- /.input-group -->
                                                    </div> <!-- /.col- -->
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <input type="text" name="mobile" value="{{ old('mobile') }}"
                                                                required>
                                                            <label>Mobile Number *</label>
                                                        </div> <!-- /.input-group -->
                                                    </div> <!-- /.col- -->
                                                    <div class="col-12">
                                                        <div class="input-group">
                                                            <input type="text" name="email" value="{{ old('email') }}"
                                                                required>
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
                                                    class="line-button-one button-rose button_update_register">
                                                    Register
                                                </button>
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

{{-- add new addresss start --}}
<div class="modal fade" id="new-address">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">ADD NEW ADDRESS</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('user.addresses.add') }}" method="post" id="formAddAddress">
                @csrf
                <div class="modal-body" style="height: 400px; overflow: auto">
                    <div class="form">

                        <div class="form-row mb--30">
                            <div class="form__group col-md-12 mb-sm--30">
                                <label for="name" class="form__label form__label--2">Name
                                    <span class="required">*</span></label>
                                <input type="text" name="name" id="name" class="form__input form__input--2" required
                                    placeholder="Name" value="">
                            </div>
                        </div>

                        @if(auth('user')->check() && !empty(auth('user')->user()->mobile))

                        <input type="hidden" name="mobile" value="{{ auth('user')->user()->mobile }}" min="0"
                            minlength="10" maxlength="10">

                        @else

                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="mobile" class="form__label form__label--2">Mobile <span
                                        class="required">*</span></label>
                                <input type="text" name="mobile" id="mobile" class="form__input form__input--2"
                                    placeholder="Mobile Number" required>
                            </div>
                        </div>

                        @endif

                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="email" class="form__label form__label--2">Email Address
                                    <span class="required">*</span></label>
                                <input type="email" name="email" id="email" class="form__input form__input--2" value=""
                                    placeholder="Email Address" required>
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
                        <input type="hidden" id="txtPincode" name="pincode">
                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="address" class="form__label form__label--2">Street Address <span
                                        class="required">*</span></label>

                                <input type="text" name="address" id="address" class="form__input form__input--2 mb--30"
                                    placeholder="House number and street name" required value="">
                            </div>
                        </div>

                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="landmark" class="form__label form__label--2">Landmark</label>
                                <input type="text" name="landmark" id="landmark" class="form__input form__input--2"
                                    placeholder="Landmark" value="">
                            </div>
                        </div>

                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="city" class="form__label form__label--2">Town / City
                                    <span class="required">*</span></label>
                                <input type="text" name="city" id="city" class="form__input form__input--2" required
                                    placeholder="Town/City" value="">
                            </div>
                        </div>

                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="territory" class="form__label form__label--2">State
                                    <span class="required">*</span></label>
                                <input type="text" name="territory" id="territory" class="form__input form__input--2"
                                    required placeholder="State" value="">
                            </div>
                        </div>


                        <div class="form-row mb--30">
                            <div class="form__group col-12">
                                <label for="type_of_address" class="form__label form__label--2">Type of Address
                                    <span class="required">*</span></label>
                                <label for="home"><input type="radio" name="type_of_address" id="home" class=""
                                        value="0" checked> Home</label>
                                <label for="corporate"><input type="radio" name="type_of_address" id="corporate"
                                        class="" value="1">
                                    Office/Commercial</label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-secondary btnSubmit">SAVE</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- add new addresss end --}}

{{-- edit addresss start --}}
<div class="modal fade" id="edit-address">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">EDIT ADDRESS</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('user.addresses.fupdate') }}" method="post" id="formUpdateAddress">
                @csrf
                <div class="modal-body" style="height: 400px; overflow: auto">
                    <div class="form" id="formEdit">

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                            <button type="submit" class="btn btn-secondary btnSubmit">UPDATE</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
{{-- edit addresss end --}}

<form action="{{ route('user.addresses.delete') }}" method="post" id="formAddDelete">
    @csrf

    <input type="hidden" name="address_id" id="txtAddID">
</form>

@endsection

@section('extracss')
<style>
    .error {
        color: rgb(238, 53, 53);
    }
    .fs-14{
        font-size: 14 !important;
    }
    .signUp-page{
        background-color: #fff;
    }
    .signUp-minimal .signin-form-wrapper{
        max-width: 540px;
    }
    .Checkout_section .login-or h3{
        margin-left: 10px;
    }
    .input-group {
        flex-wrap: inherit !important;
    }
</style>
@endsection

@section('extrajs')

<script>
    $(document).ready(function () {

        $('.order_place').attr('disabled', 'disabled');
        $('.add_address').hide();

        // var pincode = $("input[name='choose_address']:checked").attr('data-pincode');

        // $('#pincode').val(pincode);
        var pincode = $('#pincode').val();

        chkPindode(pincode);

        $('.radio-cont').change(function(){
            var pincode = $("input[name='choose_address']:checked").attr('data-pincode');

            $('#pincode').val(pincode);

            chkPindode(pincode);
        });

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

        $('.remove-address').click(function () {

            if (window.confirm('Are you sure want to delete ? ')) {

                var address_id = $(this).attr('data-obj-id');
                $('#txtAddID').val(address_id);
                $('.remove-address').html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                $('.remove-address').attr('disabled', 'disabled');
                $('#formAddDelete').submit();
            }

        });

        $('.editAddress').click(function () {

            var address_id = $(this).attr('data-obj-id');

            if (address_id.length > 0) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                $.ajax({
                    url: "{{ route('user.addresses.fedit') }}",
                    type: 'POST',
                    data: {
                        address_id: address_id,
                    },
                    success: function (result) {
                        if (result.data) {

                            var data = result.data;

                            var html =
                                `<div class="form-row mb--30">
                                    <div class="form__group col-md-12 mb-sm--30">
                                        <label for="name" class="form__label form__label--2">Name
                                            <span class="required">*</span></label>
                                        <input type="text" name="name" id="name" class="form__input form__input--2" required
                                            placeholder="Name" value="${data.name}">
                                    </div>
                                </div>

                                <div class="form-row mb--30">
                                    <div class="form__group col-md-12 mb-sm--30">
                                        <label for="mobile" class="form__label form__label--2">Mobile
                                            <span class="required">*</span></label>
                                        <input type="number" name="mobile" id="mobile" class="form__input form__input--2" required
                                            placeholder="Mobile" value="${data.mobile}">
                                    </div>
                                </div>

                                <div class="form-row mb--30">
                                    <div class="form__group col-12">
                                        <label for="address" class="form__label form__label--2">Street
                                            Address <span class="required">*</span></label>

                                        <input type="text" name="address" id="address" class="form__input form__input--2 mb--30"
                                            placeholder="House number and street name" required value="${data.address}" required>
                                    </div>
                                </div>

                                <div class="form-row mb--30">
                                    <div class="form__group col-12">
                                        <label for="landmark" class="form__label form__label--2">Landmark</label>
                                        <input type="text" name="landmark" id="landmark" class="form__input form__input--2"
                                            placeholder="Landmark" value="${data.landmark ? data.landmark : '' }">
                                    </div>
                                </div>

                                <div class="form-row mb--30">
                                    <div class="form__group col-12">
                                        <label for="city" class="form__label form__label--2">Town / City
                                            <span class="required">*</span></label>
                                        <input type="text" name="city" id="city" class="form__input form__input--2" required
                                            placeholder="Town/City" value="${data.city}" required>
                                    </div>
                                </div>

                                <div class="form-row mb--30">
                                    <div class="form__group col-12">
                                        <label for="territory" class="form__label form__label--2">State
                                            <span class="required">*</span></label>
                                        <input type="text" name="territory" id="territory" class="form__input form__input--2"
                                            required placeholder="State" value="${data.territory}" required>
                                    </div>
                                </div>

                                <input type="hidden" name="pincode" id="pincode" value="${data.pincode}" >

                                <div class="form-row mb--30">
                                    <div class="form__group col-12">
                                        <label class="form__label form__label--2">Type of Address
                                            <span class="required">*</span></label>
                                        <label for="home"><input type="radio" name="type_of_address" id="home"
                                                value="0" ${ data.type_of_address == '0' ? 'checked' : '' }> Home</label>
                                        <label for="corporate"><input type="radio" name="type_of_address" id="corporate"
                                                 value="1" ${ data.type_of_address == '1' ? 'checked' : '' }>
                                            Office/Commercial</label>
                                    </div>
                                </div>
                                <input type="hidden" name="address_id" value="${data.id}">`

                            $('#formEdit').html(html);
                            $('#edit-address').modal('show');
                        }
                    }
                });
            }


        });

        $("#formCheckout").validate({
            rules: {

                pincode: {
                    required: true,
                    minlength: 6,
                    maxlength: 6
                },

                choose_address:{
                    required: true
                }

            },
            messages: {

                pincode: {
                    required: "Please Enter Pincode",
                    minlength: "Pincode should be of 6 digits",
                    maxlength: "Pincode should be of 6 digits",
                },

                choose_address: {
                    required: "Please Select Address",
                },

            },
            submitHandler: function (form) {
                $('.order_place').attr('disabled', 'disabled');
                $(".order_place").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });

        $("#formAddAddress").validate({
            rules: {

                name: {
                    required: true
                },

                email: {
                    required: true,
                    email: true
                },

                mobile: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
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

                type_of_address: {
                    required: true
                }
            },
            messages: {

                name: {
                    required: "Please Enter Name"
                },

                email: {
                    required: "Please Enter Email",
                    email: "Please Enter Proper Email ID"
                },

                mobile: {
                    required: "Please Enter Mobile Number",
                    number: "Please Enter Proper Mobile Number",
                    minlength: "Mobile Number should be of 10 digits",
                    maxlength: "Mobile Number should be of 10 digits",
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

                type_of_address: {
                    required: "Please Select Address Type"
                },

            },
            submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });

        $("#formUpdateAddress").validate({
            rules: {

                name: {
                    required: true
                },

                email: {
                    required: true,
                    email: true
                },

                mobile: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
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

                type_of_address: {
                    required: true
                }
            },
            messages: {

                name: {
                    required: "Please Enter Name"
                },

                email: {
                    required: "Please Enter Email",
                    email: "Please Enter Proper Email ID"
                },

                mobile: {
                    required: "Please Enter Mobile Number",
                    number: "Please Enter Proper Mobile Number",
                    minlength: "Mobile Number should be of 10 digits",
                    maxlength: "Mobile Number should be of 10 digits",
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

                type_of_address: {
                    required: "Please Select Address Type"
                },

            },
            submitHandler: function (form) {
                $('.btnSubmit').attr('disabled', 'disabled');
                $(".btnSubmit").html('<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });

        $("#login-form").validate({
            rules: {

                email: {
                    required: true,
                    email: true
                },

                password: {
                    required: true,
                },

            },
            messages: {

                email: {
                    required: "Please Enter Email",
                    email: "Please Enter Proper Email ID"
                },

                password: {
                    required: "Please Enter Password"
                },

            },
            submitHandler: function (form) {
                $('.button_update_login').attr('disabled', 'disabled');
                $(".button_update_login").html(
                    '<span class="fa fa-spinner fa-spin"></span> Loading...');
                form.submit();
            }
        });

        $("#formRegister").validate({
            rules: {

                name: {
                    required: true,
                },

                mobile: {
                    required: true,
                },

                email: {
                    required: true,
                    email: true
                },

                password: {
                    required: true,
                },

            },
            messages: {

                email: {
                    required: "Please Enter Email",
                    email: "Please Enter Proper Email ID"
                },

                password: {
                    required: "Please Enter Password"
                },

                name: {
                    required: "Please Enter Name"
                },

                mobile: {
                    required: "Please Enter Mobile Number",
                    minlength: "Mobile Number should be of 10 digits only",
                    maxlength: "Mobile Number should be of 10 digits only",
                },

            },
            submitHandler: function (form) {
                $('.button_update_register').attr('disabled', 'disabled');
                $(".button_update_register").html(
                    '<span class="fa fa-spinner fa-spin"></span> Loading...');
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
            $('.pincode_button').html('<span class="fa fa-spinner fa-spin"></span>');
            $('.pincode_button').attr('disabled', 'disabled');
            $('.add_address').hide();
            $.ajax({
                url: "{{ route('verify.pincode') }}",
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
                        $('.order_place').attr('disabled', 'disabled');
                    } else {
                        $('.pincode_success').html(result.success);
                        $('.pincode_error').css('display', 'none');
                        $('.pincode_success').css('display', 'block');
                        $('.pincode_button').html('<i class="fa fa-search" aria-hidden="true"></i>');
                        $('.pincode_button').removeAttr('disabled', 'disabled');
                        $('.order_place').prop('disabled', false);
                        $('.order_place').removeClass('isDisable');
                        $('.add_address').show();
                        $('#txtPincode').val(val);
                    }
                }
            });
        } else {

            $('.pincode_error').html('Pincode should be of 6 digits');
        }
    }

</script>
@endsection