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
                                                    <tr>
                                                        <td class="product-remove text-left"><a href="#"><i
                                                                    class="dl-icon-close"></i></a></td>

                                                        <td class="product-thumbnail text-left">
                                                            <img src="{!! asset('assets/img/products/prod-14-2-70x81.jpg') !!} "
                                                                alt="Product Thumnail">
                                                        </td>
                                                        <td class="product-name text-left wide-column">
                                                            <h3>
                                                                <a href="#">Super skinny blazer</a>
                                                            </h3>
                                                        </td>
                                                        <td class="product-price">
                                                            <span class="product-price-wrapper">
                                                                <span class="money">₹49.00</span>
                                                            </span>
                                                        </td>
                                                        <td class="product-quantity">
                                                            <div class="quantity">
                                                                <input type="number" class="quantity-input" name="qty"
                                                                    id="qty-1" value="1" min="1">
                                                            </div>
                                                        </td>
                                                        <td class="product-total-price">
                                                            <span class="product-price-wrapper">
                                                                <span class="money"><strong>₹49.00</strong></span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="product-remove text-left"><a href="#"><i
                                                                    class="dl-icon-close"></i></a></td>
                                                        <td class="product-thumbnail text-left">

                                                            <img src="{!! asset('assets/img/products/prod-9-1-70x81.jpg') !!} "
                                                                alt="Product Thumnail">
                                                        </td>
                                                        <td class="product-name text-left wide-column">
                                                            <h3>
                                                                <a href="#"> Jogging trousers</a>
                                                            </h3>
                                                        </td>
                                                        <td class="product-price">
                                                            <span class="product-price-wrapper">
                                                                <span class="money">₹49.00</span>
                                                            </span>
                                                        </td>
                                                        <td class="product-quantity">
                                                            <div class="quantity">
                                                                <input type="number" class="quantity-input" name="qty"
                                                                    id="qty-2" value="1" min="1">
                                                            </div>
                                                        </td>
                                                        <td class="product-total-price">
                                                            <span class="product-price-wrapper">
                                                                <span class="money"><strong>₹49.00</strong></span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="product-remove text-left"><a href="#"><i
                                                                    class="dl-icon-close"></i></a></td>
                                                        <td class="product-thumbnail text-left">

                                                            <img src="{!! asset('assets/img/products/prod-10-1-70x81.jpg') !!} "
                                                                alt="Product Thumnail">
                                                        </td>
                                                        <td class="product-name text-left wide-column">
                                                            <h3>
                                                                <a href="#"> Grey blue leather
                                                                    backpack</a>
                                                            </h3>
                                                        </td>
                                                        <td class="product-price">
                                                            <span class="product-price-wrapper">
                                                                <span class="money">₹49.00</span>
                                                            </span>
                                                        </td>
                                                        <td class="product-quantity">
                                                            <div class="quantity">
                                                                <input type="number" class="quantity-input" name="qty"
                                                                    id="qty-3" value="1" min="1">
                                                            </div>
                                                        </td>
                                                        <td class="product-total-price">
                                                            <span class="product-price-wrapper">
                                                                <span class="money"><strong>₹49.00</strong></span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="product-remove text-left"><a href="#"><i
                                                                    class="dl-icon-close"></i></a></td>
                                                        <td class="product-thumbnail text-left">

                                                            <img src="{!! asset('assets/img/products/prod-11-1-70x81.jpg') !!} "
                                                                alt="Product Thumnail">
                                                        </td>
                                                        <td class="product-name text-left wide-column">
                                                            <h3>
                                                                <a href="#">Dress with belt</a>
                                                            </h3>
                                                        </td>
                                                        <td class="product-price">
                                                            <span class="product-price-wrapper">
                                                                <span class="money">₹49.00</span>
                                                            </span>
                                                        </td>
                                                        <td class="product-quantity">
                                                            <div class="quantity">
                                                                <input type="number" class="quantity-input" name="qty"
                                                                    id="qty-4" value="1" min="1">
                                                            </div>
                                                        </td>
                                                        <td class="product-total-price">
                                                            <span class="product-price-wrapper">
                                                                <span class="money"><strong>₹49.00</strong></span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row no-gutters border-top pt--20 mt--20">
                                    <div class="col-sm-6">
                                        <div class="coupon">
                                            <input type="text" id="coupon" name="coupon" class="cart-form__input"
                                                placeholder="Coupon Code">
                                            <button type="submit" class="cart-form__btn">Apply Coupon</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-sm-right">
                                        <button type="submit" class="cart-form__btn">Clear Cart</button>
                                        <button type="submit" class="cart-form__btn">Update Cart</button>
                                    </div>
                                </div> -->
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="cart-collaterals">
                                <div class="cart-totals">
                                    <h5 class="mb--15">Cart totals</h5>
                                   
                                    <div class="table-content table-responsive">
                                        <table class="table order-table">
                                            <tbody>
                                                <tr>
                                                    <th>Subtotal</th>
                                                    <td>₹196.00</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping</th>
                                                    <td>
                                                        <span>Flat rate: ₹20.00</span>
                                                        <div class="shipping-calculator-wrap">
                                                            <a href="#shipping_calculator" class="expand-btn">Calculate
                                                                Shipping</a>
                                                            <form id="shipping_calculator"
                                                                class="form shipping-calculator-form hide-in-default">
                                                                <div class="form__group mb--10">
                                                                    <select id="calc_shipping_country"
                                                                        name="calc_shipping_country"
                                                                        class="nice-select">
                                                                        <option value="">Select a country…</option>
                                                                        <option value="AF">Afghanistan</option>
                                                                        <option value="AL">Albania</option>
                                                                        <option value="DZ">Algeria</option>
                                                                        <option value="AR">Argentina</option>
                                                                        <option value="AM">Armenia</option>
                                                                        <option value="AU">Australia</option>
                                                                        <option value="AT">Austria</option>
                                                                        <option value="AZ">Azerbaijan</option>
                                                                        <option value="BH">Bahrain</option>
                                                                        <option value="BD" selected="selected">
                                                                            Bangladesh</option>
                                                                        <option value="BD">Brazil</option>
                                                                        <option value="CN">China</option>
                                                                        <option value="EG">Egypt</option>
                                                                        <option value="FR">France</option>
                                                                        <option value="DE">Germany</option>
                                                                        <option value="HK">Hong Kong</option>
                                                                        <option value="HU">Hungary</option>
                                                                        <option value="IS">Iceland</option>
                                                                        <option value="IN">India</option>
                                                                        <option value="ID">Indonesia</option>
                                                                        <option value="IR">Iran</option>
                                                                        <option value="IQ">Iraq</option>
                                                                        <option value="IE">Ireland</option>
                                                                        <option value="IT">Italy</option>
                                                                        <option value="JP">Japan</option>
                                                                        <option value="KW">Kuwait</option>
                                                                        <option value="MY">Malaysia</option>
                                                                        <option value="MV">Maldives</option>
                                                                        <option value="MX">Mexico</option>
                                                                        <option value="MC">Monaco</option>
                                                                        <option value="NP">Nepal</option>
                                                                        <option value="RU">Russia</option>
                                                                        <option value="KR">South Korea</option>
                                                                        <option value="SS">South Sudan</option>
                                                                        <option value="ES">Spain</option>
                                                                        <option value="LK">Sri Lanka</option>
                                                                        <option value="SD">Sudan</option>
                                                                        <option value="SZ">Swaziland</option>
                                                                        <option value="SE">Sweden</option>
                                                                        <option value="CH">Switzerland</option>
                                                                        <option value="TN">Tunisia</option>
                                                                        <option value="TR">Turkey</option>
                                                                        <option value="UA">Ukraine</option>
                                                                        <option value="AE">United Arab Emirates</option>
                                                                        <option value="GB">United Kingdom (UK)</option>
                                                                        <option value="US">United States (US)</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form__group mb--10">
                                                                    <select id="calc_shipping_district"
                                                                        name="calc_shipping_district"
                                                                        class="nice-select">
                                                                        <option value="">Select a District…</option>
                                                                        <option>BARISAL</option>
                                                                        <option>BHOLA</option>
                                                                        <option>BANDARBAN</option>
                                                                        <option>BRAHMANBARIA</option>
                                                                        <option>CHANDPUR</option>
                                                                        <option>CHITTAGONG</option>
                                                                        <option>COMILLA</option>
                                                                        <option>COX'S BAZAR</option>
                                                                        <option>DHAKA</option>
                                                                        <option>FARIDPUR</option>
                                                                        <option>FENI</option>
                                                                        <option>GAZIPUR</option>
                                                                        <option>GOPALGANJ</option>
                                                                        <option>JAMALPUR</option>
                                                                        <option>KHAGRACHHARI</option>
                                                                        <option>KISHOREGONJ</option>
                                                                        <option>LAKSHMIPU</option>
                                                                        <option>RMADARIPUR</option>
                                                                        <option>MUNSHIGANJ</option>
                                                                        <option>MYMENSINGH</option>
                                                                        <option>NARAYANGANJ</option>
                                                                        <option>NARSINGDI</option>
                                                                        <option>NETRAKONA</option>
                                                                        <option>NOAKHALI</option>
                                                                        <option>RANGAMATI </option>
                                                                        <option>RAJBARI</option>
                                                                        <option>SHARIATPUR</option>
                                                                        <option>SHERPUR</option>
                                                                        <option>TANGAIL</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form__group mb--10">
                                                                    <input type="text" name="calc_shipping_city"
                                                                        id="calc_shipping_city"
                                                                        placeholder="Town / City">
                                                                </div>

                                                                <div class="form__group mb--10">
                                                                    <input type="text" name="calc_shipping_zip"
                                                                        id="calc_shipping_zip"
                                                                        placeholder="Postcode / Zip">
                                                                </div>

                                                                <div class="form__group">
                                                                    <input type="submit" value="Update Totals">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td>
                                                        <span class="product-price-wrapper">
                                                            <span class="money">₹226.00</span>
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
                                <a href="{{ route('product-detail') }}" class="btn btn-cls btn-fullwidth btn-style-1 mt--10">
                                     Continue   Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content Wrapper Start -->
@endsection
