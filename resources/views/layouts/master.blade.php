<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Hni Lifestyle" />

    <link rel="apple-touch-icon" sizes="57x57" href="{!! asset('assets/img/logo/favicon/apple-icon-57x57.png') !!}">
    <link rel="apple-touch-icon" sizes="60x60" href="{!! asset('assets/img/logo/favicon/apple-icon-60x60.png') !!}">
    <link rel="apple-touch-icon" sizes="72x72" href="{!! asset('assets/img/logo/favicon/apple-icon-72x72.png') !!}">
    <link rel="apple-touch-icon" sizes="76x76" href="{!! asset('assets/img/logo/favicon/apple-icon-76x76.png') !!}">
    <link rel="apple-touch-icon" sizes="114x114" href="{!! asset('assets/img/logo/favicon/apple-icon-114x114.png') !!}">
    <link rel="apple-touch-icon" sizes="120x120" href="{!! asset('assets/img/logo/favicon/apple-icon-120x120.png') !!}">
    <link rel="apple-touch-icon" sizes="144x144" href="{!! asset('assets/img/logo/favicon/apple-icon-144x144.png') !!}">
    <link rel="apple-touch-icon" sizes="152x152" href="{!! asset('assets/img/logo/favicon/apple-icon-152x152.png') !!}">
    <link rel="apple-touch-icon" sizes="180x180" href="{!! asset('assets/img/logo/favicon/apple-icon-180x180.png') !!}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{!! asset('assets/img/logo/favicon/android-icon-192x192.png') !!}">
    <link rel="icon" type="image/png" sizes="32x32" href="{!! asset('assets/img/logo/favicon/favicon-32x32.png') !!}">
    <link rel="icon" type="image/png" sizes="96x96" href="{!! asset('assets/img/logo/favicon/favicon-96x96.png') !!}">
    <link rel="icon" type="image/png" sizes="16x16" href="{!! asset('assets/img/logo/favicon/favicon-16x16.png') !!}">
    <link rel="manifest" href="{!! asset('assets/img/logo/favicon/manifest.json') !!}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{!! asset('assets/img/logo/favicon/ms-icon-144x144.png') !!}">
    <meta name="theme-color" content="#ffffff">
    <!-- Favicons -->

    <!-- Title -->
    @notifyCss
    <title>@yield('title') || Hnilifestyle</title>

    <!-- ************************* CSS Files ************************* -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{!! asset('assets/css/bootstrap.min.css') !!}" />

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/10dbd8ec26.css">
    <!--<link rel="stylesheet" href="{!! asset('assets/css/font-awesome.min.css') !!}" />-->

    <!-- dl Icon CSS -->
    <link rel="stylesheet" href="{!! asset('assets/css/dl-icon.css') !!}" />

    <!-- All Plugins CSS -->
    <link rel="stylesheet" href="{!! asset('assets/css/plugins.css') !!}" />

    <!-- Revoulation Slider CSS  -->
    <link rel="stylesheet" href="{!! asset('assets/css/revoulation.css') !!}" />

    <!-- style CSS -->
    <link rel="stylesheet" href="{!! asset('assets/css/main.css') !!}" />

    <!-- modernizr JS
    ============================================ -->
    <script src="{!! asset('assets/js/vendor/modernizr-2.8.3.min.js') !!}"></script>


    @yield('extracss')
    <style>
        .pop-message-body {
            position: fixed;
            bottom: 30px;
            z-index: 999;
            width: 100%;
        }

        .flex-container {
            display: flex;
            justify-content: center;
        }

        .flex-container>#dangerSnackbar,
        .flex-container>#successSnackbar {
            min-width: 250px;
            max-width: 600px;
            padding: 10px;
            z-index: 9999;
            bottom: 30px;
            font-size: 17px;
            list-style: none;
            border-radius: 5px;
            box-shadow: 1px 2px 5px rgba(0, 0, 0, 0.377);
            text-align: center;
        }

        .flex-container>#successSnackbar {
            visibility: hidden;
            background-color: #dff0d8;
            color: #3c763d;
            border-color: #dff0d8;
        }

        .flex-container>#successSnackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        .flex-container>#dangerSnackbar {
            visibility: hidden;
            background-color: #f8d7da;
            color: #a94442;
            border-color: #f5c6cb;
        }

        .flex-container>#dangerSnackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        .header-style-4 .logo-box figure {
            width: 85px;
        }

        .searchform-3 .searchform__submit {
            padding-top: 3px;
        }

        .error {
            color: rgb(238, 53, 53);
        }

    </style>

    <!-- Facebook Pixel Code -->
    <script>
        ! function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '2404218679835175');
        fbq('track', 'PageView');

    </script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=2404218679835175&ev=PageView
    &noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->
</head>

<body class="home-22 template-color-2">
    <!-- <div class="ai-preloader active">
        <div class="ai-preloader-inner h-100 d-flex align-items-center justify-content-center">
            <div class="ai-child ai-bounce1"></div>
            <div class="ai-child ai-bounce2"></div>
            <div class="ai-child ai-bounce3"></div>
        </div>
    </div> -->

    <!-- Main Wrapper Start -->
    <div class="wrapper">
        <!-- Header Area Start -->

        <header class="header header-fullwidth header-style-4">
            <div class="header-outer">
                <div class="header-inner fixed-header">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-3 col-4 order-1">
                                <div class="header-left d-flex">
                                    <!-- Logo Start Here -->
                                    <a href="{{ route('index') }}" class="logo-box">
                                        <figure class="logo--normal">
                                            <img src="{!! asset('assets/img/logo/logo.png') !!}" alt="Logo" />
                                        </figure>
                                        <figure class="logo--transparency">
                                            <img src="{!! asset('assets/img/logo/logo.png') !!}" alt="Logo" />
                                        </figure>
                                    </a>
                                    <!-- Logo End Here -->
                                </div>
                            </div>

                            <div class="col-lg-5 order-3 order-lg-2">
                                <!-- Main Navigation Start Here -->
                                <nav class="main-navigation">
                                    {!! $dynamicCategory !!}
                                </nav>
                                <!-- Main Navigation End Here -->
                            </div>

                            <div class="col-lg-5 col-md-9 col-8 order-2 order-lg-3">
                                <ul class="header-toolbar text-right">
                                    <li class="header-toolbar__item">
                                        <div class="header-component__item header-component__search-form">
                                            <div class="header-search-form-wrap">
                                                <form action="{{ route('search') }}" method="GET"
                                                    class="searchform searchform-3">
                                                    <input name="q" type="text" value="{{ Request::get('q') }}"
                                                        list="suggestion" id="search-box" class="searchform__input"
                                                        autocomplete="off"
                                                        placeholder="Search by product, category..." />
                                                    <datalist id="suggestion">
                                                        @foreach($keywords as $key)
                                                        <option value="{{ $key->keyword }}">
                                                            @endforeach
                                                        </option>
                                                    </datalist>

                                                    <button type="submit" class="searchform__submit">
                                                        <i class="dl-icon-search4" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <a href="#sideNav" class="toolbar-btn ml--10">
                                            <i class="dl-icon-user3"></i>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <a href="#" class="mini-cart-btn toolbar-btn">
                                            <i class="dl-icon-heart3"></i>
                                            <sup class="mini-cart-count">2</sup>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <a href="#miniCart" class="mini-cart-btn toolbar-btn">
                                            <i class="dl-icon-cart4" aria-hidden="true"></i>
                                            @if(Cart::getContent()->count() != 0)
                                            <sup class="mini-cart-count">{{ Cart::getContent()->count() }}</sup>
                                            @endif
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item d-lg-none">
                                        <a href="#" class="menu-btn"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-sticky-header-height"></div>
            </div>
        </header>
        <!-- Header Area End -->

        <!-- Mobile Header area Start -->
        <header class="header-mobile">
            <div class="header-mobile__outer">
                <div class="header-mobile__inner fixed-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <a href="{{ route('index') }}" class="logo-box">
                                    <figure class="logo--normal">
                                        <img src="{!! asset('assets/img/logo/logo.png') !!}" alt="Logo">
                                    </figure>
                                </a>
                            </div>
                            <div class="col-8">
                                <ul class="header-toolbar text-right">
                                    <li class="header-toolbar__item user-info-menu-btn">
                                        <a href="#">
                                            <i class="dl-icon-user3 toolbar-btn-cls text-black"></i>
                                        </a>
                                        <ul class="user-info-menu">
                                            @if(auth('user')->check())
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <i class="dl-icon-user3 text-black"></i>
                                                    {{ Str::limit(auth('user')->user()->name,16,'') }}</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('user.dashboard') }}">Dashboard</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('user.profile') }}">My Account</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('user.showOrder') }}">Orders</a>
                                            </li>

                                            <!-- <li><a href="#">Download</a></li> -->
                                            <li>
                                                <a href="{{ route('user.change-password') }}">Change Password</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('user.addresses') }}">Manage Addresses</a>
                                            </li>

                                            <li>
                                                <a href="javascript:void(0)"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                    title="Logout">
                                                    Logout
                                                </a>
                                                <form id="logout-form" action="/myaccount/logout" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                            @else
                                            <li>
                                                <a href="{{
                                                        route('user.login')
                                                    }}">Login</a>
                                            </li>
                                            <li>
                                                <a href="{{
                                                        route(
                                                            'user.register'
                                                        )
                                                    }}">Register</a>
                                            </li>
                                            @endif
                                        </ul>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <a href="#" class="mini-cart-btn toolbar-btn">
                                            <i class="dl-icon-heart3 toolbar-btn-cls text-black" aria-hidden="true"></i>
                                            <sup class="mini-cart-count">2</sup>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <a href="#miniCart" class="mini-cart-btn toolbar-btn">
                                            <i class="dl-icon-cart4 toolbar-btn-cls text-black" aria-hidden="true"></i>
                                            @if(Cart::getContent()->count() != 0)
                                            <sup class="mini-cart-count">{{ Cart::getContent()->count() }}</sup>
                                            @endif

                                        </a>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <a href="#searchForm" class="search-btn toolbar-btn">
                                            <i class="dl-icon-search4 toolbar-btn-cls text-black"
                                                aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item d-lg-none">
                                        <a href="#" class="menu-btn"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- Mobile Navigation Start Here -->
                                <div class="mobile-navigation dl-menuwrapper" id="dl-menu">
                                    <button class="dl-trigger">Open Menu</button>
                                    {!! $smallDeviceDynamicCategory !!}
                                </div>
                                <!-- Mobile Navigation End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile-sticky-header-height"></div>
            </div>
        </header>
        <!-- Mobile Header area End -->

        @yield('content')

        <!-- Footer Start -->
        <footer class="footer footer-5 footer-cls ">
            <div class="container">
                <div class="footer-top border-bottom pt--40 pb--30">
                    <div class="row">
                        <div class="footer-column-1 mb-md--40  mb-xs--20">
                            <div class="footer-widget">
                                <h3 class="widget-title widget-title--2">
                                    Main Category
                                </h3>
                                <ul class="widget-menu widget-menu--3 ">
                                    @foreach($footerDynamicCategory as $mainCat)
                                    <li>
                                        <a
                                            href="{!! asset('category').'/'.$mainCat->slug_url !!}">{{ $mainCat->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="footer-column-2 mb-xs--20">
                            <div class="footer-widget">
                                <h3 class="widget-title widget-title--2">
                                    Company
                                </h3>
                                <ul class="widget-menu widget-menu--3 ">
                                    <li>
                                        <a href="{{ route('about') }}">ABOUT US</a>
                                    </li>
                                    <!-- <li><a href="#">SHOP</a></li> -->
                                    <!-- <li><a href="/all-product">PRODUCT</a></li> -->
                                    <li>
                                        <a href="{{ route('contact') }}">CONTACT US</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('faq') }}">FAQ'S</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-column-3 mb-xs--20">
                            <div class="footer-widget">
                                <h3 class="widget-title widget-title--2">
                                    Policy
                                </h3>
                                <ul class="widget-menu widget-menu--3">
                                    <li>
                                        <a href="{{
                                                    route('terms-condition')
                                                }}">TERMS &amp; CONDITIONS</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('privacy') }}">
                                            PRIVACY POLICY</a>
                                    </li>

                                    <li>
                                        <a href="{{
                                                    route('cancellation')
                                                }}">CANCELLATION POLICY</a>
                                    </li>

                                    <li>
                                        <a href="{{
                                                    route('refund-return')
                                                }}">REFUND &amp; RETURN POLICY</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="footer-column-4 mb-xs--20">
                            <div class="footer-widget">
                                <h3 class="widget-title widget-title--2">Contact Info</h3>
                                <ul class="contact-info">
                                    <li class="contact-info__item">
                                        <i class="fa fa-phone"></i>
                                        <span><a href="tel:+919619614785" class="contact-info__link">(+91) 961 9614
                                                785</a></span>
                                    </li>
                                    <li class="contact-info__item">
                                        <i class="fa fa-envelope"></i>
                                        <span><a href="mailto:support@hnilifestyle.com"
                                                class="contact-info__link">support@hnilifestyle.com</a></span>
                                    </li>
                                    <li class="contact-info__item">
                                        <i class="fa fa-map-marker"></i>
                                        <span>KHUSHI NATURALS,<br />
                                            Unit no.112, 1st Floor, Bldg no.A6,Harihar Complex, Dapode,Thane-
                                            421302.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-column-5 mb-xs--20">
                            <div class="footer-widget">
                                <h3 class="widget-title widget-title--2">
                                    Keep Up To Date
                                </h3>
                                <div class="form-widget mb--20">
                                    <form action="{{ route('subscribe') }}" id="formSubscribe"
                                        class="newsletter-form newsletter-form--6 mc-form" method="post">
                                        @csrf
                                        <input type="email" name="newsletter-email" id="newsletter-email"
                                            class="newsletter-form__input" placeholder="Enter Your Email Address.."
                                            required />
                                        <button type="submit" class="newsletter-form__submit btnSubscribe">
                                            Subscribe
                                        </button>
                                    </form>
                                </div>
                                <div class="textwidget">
                                    <ul class="social">
                                        <li class="social__item">
                                            <a href="https://www.facebook.com/hnilifestyle" target="_blank"
                                                class="social__link" target="_blank" rel="nofollow noopener noreferrer">
                                                <i class="fa fa-facebook"></i>
                                                <span class="sr-only">Facebook</span>
                                            </a>
                                        </li>
                                        <li class="social__item">
                                            <a href="https://www.instagram.com/hni.lifestyle/" target="_blank"
                                                class="social__link" target="_blank" rel="nofollow noopener noreferrer">
                                                <i class="fa fa-instagram"></i>
                                                <span class="sr-only">Instagram</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="textwidget mt--15">
                                    <img src="{!! asset('assets/img/icons/payment-method.jpg') !!}" alt="Payment">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom ptb--15 sm-padding-footer">
                    <div class="row">
                        <div class="col-sm-12 text-sm-left text-center">
                            <p class="copyright-text">
                                Copyright © {{ Date('Y') === '2019' ? '2019' : '2019' . ' - ' . Date('Y') }}
                                <a href="#">Hnilifestyle </a> All Right
                                Reserved | Designed &amp; Developed by
                                <a href="https://sanjaresolutions.com" style="color:#f1894c" target="_blank">Sanjar E
                                    Solutions</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer End -->

        <!-- Search from Start -->
        <div class="searchform__popup" id="searchForm">
            <a href="#" class="btn-close"><i class="fa fa-times" aria-hidden="true"></i></a>
            <div class="searchform__body">
                <p>Start typing and press Enter to search</p>
                <form class="searchform" action="{{ route('search') }}" method="GET">
                    <input name="q" placeholder="Search entire store here ..." type="text"
                        value="{{ Request::get('q') }}" id="search-box1" class="searchform__input" autocomplete="off" />
                    <datalist id="suggestion1">
                        @foreach($keywords as $key)
                        <option value="{{ $key->keyword }}">
                        </option>
                        @endforeach
                    </datalist>

                    <button type="submit" class="searchform__submit">
                        <i class="dl-icon-search4" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
        <!-- Search from End -->

        <!-- Side Navigation Start -->
        <aside class="side-navigation" id="sideNav">
            <div class="side-navigation-wrapper">
                <a href="#" class="btn-close"><i class="fa fa-times" aria-hidden="true"></i></a>
                <div class="side-navigation-inner">
                    <div class="widget">
                        <ul class="sidenav-menu">
                            @if(auth('user')->check())
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="dl-icon-user3"></i>
                                    {{ Str::limit(auth('user')->user()->name,16,'') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('user.dashboard') }}">Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile') }}">My Account</a>
                            </li>
                            <li>
                                <a href="{{ route('user.showOrder') }}">Orders</a>
                            </li>

                            <!-- <li><a href="#">Download</a></li> -->
                            <li>
                                <a href="{{ route('user.change-password') }}">Change Password</a>
                            </li>

                            <li>
                                <a href="{{ route('user.addresses') }}">Manage Addresses</a>
                            </li>

                            <li>
                                <a href="javascript:void(0)"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    title="Logout">
                                    Logout
                                </a>
                                <form id="logout-form" action="/myaccount/logout" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @else
                            <li>
                                <a href="{{ route('user.login') }}">Login</a>
                            </li>
                            <li>
                                <a href="{{ route('user.register') }}">Register</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Side Navigation End -->

        <!-- Mini Cart Start -->
        <aside class="mini-cart" id="miniCart">
            <div class="mini-cart-wrapper">
                <a href="#" class="btn-close"><i class="fa fa-times" aria-hidden="true"></i></a>
                <div class="mini-cart-inner">
                    <h5 class="mini-cart__heading mb--40 mb-lg--30">
                        Shopping Cart
                    </h5>
                    @if(Cart::isEmpty())
                    <div class="row">
                        <div class="col-md-12 mb-50 mt-50">
                            <div class="alert alert-warning text-center">
                                <h4>Your cart is empty... You can add some product from <a href="/search">here</a></h4>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="mini-cart__content">
                        <ul class="mini-cart__list">
                            @foreach (Cart::getcontent() as $item)

                            <li class="mini-cart__product">
                                <a href="#" class="remove-from-cart remove btn-remove-item"
                                    data-remove-id="{{ $item->id }}">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <div class="mini-cart__product__image">
                                    <img src="{!! asset('storage/images/multi-products/'.$item->attributes->color_image) !!}"
                                        alt="{{ $item->name }}" />
                                </div>
                                <div class="mini-cart__product__content">
                                    <a class="mini-cart__product__title"
                                        href="{{ route('product', $item->attributes->slug_url) }}">{{ $item->name }}
                                    </a>
                                    <span class="mini-cart__product__quantity">{{ $item->quantity }} x
                                        ₹{{ $item->price }}</span>
                                </div>
                            </li>

                            @endforeach
                        </ul>
                        <div class="mini-cart__total">
                            <span>Total</span>
                            <span class="ammount">₹{{ Cart::getTotal() }}</span>
                        </div>
                        <div class="mini-cart__buttons">
                            <a href="{{ route('cart') }}" class="btn btn-fullwidth btn-style-1">View Cart</a>
                            <a href="{{ route('checkout') }}" class="btn btn-fullwidth btn-style-1">Checkout</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </aside>

        <div class="modal fade" id="modalLogin">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Login </h4>
                        <button type="button" class="close cclose" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="signUp-page signUp-minimal pt-0">
                            <div class="signin-form-wrapper">
                                <!-- <div class="title-area text-center">
                                    <h3>Login.</h3>
                                </div>  -->
                                <form id="login-form" action="/myaccount/login" method="POST" autocomplete="off"
                                    class="login">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group">
                                                <input type="text" name="email" value="{{ old('email') }}" required />
                                                <label>Email *</label>
                                            </div>
                                            <!-- /.input-group -->
                                        </div>
                                        <!-- /.col- -->
                                        <div class="col-12">
                                            <div class="input-group">
                                                <input type="password" name="password" required />
                                                <label>Password *</label>
                                            </div>
                                            <!-- /.input-group -->
                                        </div>
                                        <!-- /.col- -->
                                    </div>
                                    <!-- /.row -->
                                    <div class="agreement-checkbox d-flex justify-content-between align-items-center">
                                        <div>
                                            <input type="checkbox" name="remember"
                                                {{ old("remember") ? "checked" : "" }} checked id="remember">
                                            <label for="remember">Remember Me</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="line-button-one button-rose button_update_login">
                                        Login
                                    </button>
                                </form>
                                <p class="signUp-text text-center">
                                    Don’t have any account?
                                    <a href="{{ route('user.register') }}">Register</a> now. &
                                    <a href="{{ route('user.login.otp') }}"> Login With Otp</a>
                                </p>
                                <p class="or-text"><span>or</span></p>
                                <ul class="social-icon-wrapper row">
                                    <li class="col-12">
                                        <a href="{{ route('user.auth.socialite', 'google') }}" class="gmail"><i
                                                class="fa fa-envelope-o" aria-hidden="true"></i>
                                            Gmail</a>
                                    </li>
                                    <li class="col-12">
                                        <a href="{{ route('user.auth.socialite', 'facebook') }}" class="facebook"><i
                                                class="fa fa-facebook" aria-hidden="true"></i>
                                            Facebook</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.sign-up-form-wrapper -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('cart.delete') }}" id="frmDeleteItem" method="POST">
            @csrf
            <input type="hidden" name="item_id" required="required" id="hiddenFieldDeleteItemId" />
        </form>

        <form action="{{ route('wishlist.add') }}" id="frmAddWishlist" method="POST">
            @csrf
            <input type="hidden" name="p_id" id="txtProductId" />
            <input type="hidden" name="c_id" id="txtColorId" />
            <input type="hidden" name="s_id" id="txtSizeId" />
        </form>
        <!-- Mini Cart End -->

        <!-- Global Overlay Start -->
        <div class="ai-global-overlay"></div>
        <!-- Global Overlay End -->
    </div>
    <!-- Main Wrapper End -->

    <!-- ************************* JS Files ************************* -->

    <!-- jQuery JS -->
    <script src="{!! asset('/assets/js/vendor/jquery.min.js') !!}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js">
    </script>

    <!-- Bootstrap and Popper Bundle JS -->

    <script src="{!! asset('/assets/js/bootstrap.bundle.min.js') !!}"></script>

    <!-- All Plugins Js -->

    <script src="{!! asset('/assets/js/plugins.js') !!}"></script>

    <!-- Main JS -->

    <script src="{!! asset('assets/js/main.js') !!}"></script>

    <!-- REVOLUTION JS FILES -->

    <script src="{!! asset('assets/js/revoulation/jquery.themepunch.tools.min.js') !!}"></script>

    <script src="{!! asset('assets/js/revoulation/jquery.themepunch.revolution.min.js') !!}"></script>

    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->

    <script src="{!! asset('assets/js/revoulation/extensions/revolution.extension.actions.min.js') !!}"></script>

    <script src="{!! asset('assets/js/revoulation/extensions/revolution.extension.carousel.min.js') !!}"></script>

    <script src="{!! asset('assets/js/revoulation/extensions/revolution.extension.kenburn.min.js') !!}"></script>

    <script src="{!! asset('assets/js/revoulation/extensions/revolution.extension.layeranimation.min.js') !!}"></script>

    <script src="{!! asset('assets/js/revoulation/extensions/revolution.extension.migration.min.js') !!}"></script>

    <script src="{!! asset('assets/js/revoulation/extensions/revolution.extension.navigation.min.js') !!}"></script>

    <script src="{!! asset('assets/js/revoulation/extensions/revolution.extension.parallax.min.js') !!}"></script>

    <script src="{!! asset('assets/js/revoulation/extensions/revolution.extension.slideanims.min.js') !!}"></script>

    <script src="{!! asset('assets/js/revoulation/extensions/revolution.extension.video.min.js') !!}"></script>

    <script src="{!! asset('admin/bundles/sweetalert/sweetalert.min.js') !!}"></script>

    <script src="{!! asset('admin/js/jquery.validate.min.js') !!}"></script>

    <!-- REVOLUTION ACTIVE JS FILES -->

    <script src="{!! asset('assets/js/revoulation.js') !!}"></script>
    {{-- <script src="{!! asset('assets/js/jquery.lazyload.js') !!}"></script> --}}

    @yield('extrajs')
    @include('notify::messages')
    @notifyJs
    <script>
        $(document).ready(function () {

            $(".lazy").Lazy({
                effect: 'fadeIn',
                visibleOnly: true,
            });

            $("#search-box").on("input", function () {
                if ($(this).val()) {
                    $(this).attr("list", "suggestion");
                } else {
                    $(this).removeAttr("list");
                }
            });

            $("#search-box1").on("input", function () {
                if ($(this).val()) {
                    $(this).attr("list", "suggestion1");
                } else {
                    $(this).removeAttr("list");
                }
            });

            $(".btn-remove-item").click(function () {
                if (window.confirm("Are you sure want to remove this product ?")) {
                    $("#hiddenFieldDeleteItemId").val($(this).attr('data-remove-id'));
                    $("#frmDeleteItem").submit();
                    $(this).attr("disabled", "disabled");
                    $(this).html(
                        '<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span>'
                    );
                }
            });

            $(".wishlist").click(function () {
                var pid = $(this).attr('data-p-id');
                var cid = $(this).attr('data-c-id');
                var sid = $(this).attr('data-s-id');

            });

            $(".wishlist-login").click(function () {

                $('#modalLogin').modal('show');

            });

            $("#formSubscribe").validate({
                rules: {

                    EMAIL: {
                        required: true,
                        email: true
                    },
                },

                messages: {

                    EMAIL: {
                        required: "Please Enter Email",
                        email: "Please Enter Proper Email ID"
                    },

                },

                submitHandler: function (form) {
                    $('.btnSubscribe').attr('disabled', 'disabled');
                    $(".btnSubscribe").html(
                        '<span class="fa fa-spinner fa-spin"></span> Loading...');
                    form.submit();
                }
            });

            $('.gmail').click(function () {
                $(this).attr('disabled', 'disabled');
                $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
            });

            $('.facebook').click(function () {
                $(this).attr('disabled', 'disabled');
                $(this).html('<span class="fa fa-spinner fa-spin"></span> Loading...');
            });

            var navheight = $(".fixed-header").height();
            var mob_navheight = $(".header-mobile__inner").height();
            if ($(window).width() > 991) {
                $("#homepage-slider-1").css("margin-top", navheight - 13);
            } else {
                $("#homepage-slider-1").css("margin-top", 0);
            }

        });

    </script>
</body>

</html>
