<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="meta description" />
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('assets/img/logo/favicon.ico') !!}">
    <link rel="apple-touch-icon" sizes="192x192" href="{!! asset('assets/img/logo/favicon.ico') !!}">
    <link rel="icon" href="{!! asset('assets/img/logo/favicon.ico') !!}" sizes="192x192">
    <!-- Favicons -->

    <!-- Title -->

    <title>@yield('title') || Hnilifestyle</title>

    <!-- ************************* CSS Files ************************* -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{!! asset('assets/css/bootstrap.min.css') !!}" />

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{!! asset('assets/css/font-awesome.min.css') !!}" />

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

    <!--[if lt IE 9]>
            <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
            width: 140px;
        }

    </style>
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
                    <div class="container-fluid">
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

                            <div class="col-lg-8 order-3 order-lg-2">
                                <!-- Main Navigation Start Here -->
                                <nav class="main-navigation">
                                    {!! $dynamicCategory !!}
                                </nav>
                                <!-- Main Navigation End Here -->
                            </div>

                            <div class="col-lg-2 col-md-9 col-8 order-2 order-lg-3">
                                <ul class="header-toolbar text-right">
                                    <li class="header-toolbar__item">
                                        <a href="#sideNav" class="toolbar-btn ">
                                            <i class="fa fa-user-circle-o"></i>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <a href="#miniCart" class="mini-cart-btn toolbar-btn">
                                            <i class="dl-icon-cart4"></i>
                                            <sup class="mini-cart-count">2</sup>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <div class="header-component__item header-component__search-form">
                                            <div class="header-search-form-wrap">
                                                <form action="/search" method="GET" class="searchform searchform-3">
                                                    <input name="q" type="text"
                                                        value="{{ Request::get('q') }}" list="suggestion1" id="search-box1" class="searchform__input" autocomplete="off" placeholder="Search products..." />
                                                    <datalist id="suggestion1">
                                                        @foreach($keywords as $key)
                                                        <option value="{{ $key->keyword }}">
                                                            @endforeach
                                                        </option>
                                                    </datalist>
                                                    
                                                    <button type="submit" class="searchform__submit">
                                                        <i class="dl-icon-search4"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
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
                                        <a href="#sideNav" class="toolbar-btn ">
                                            <i class="fa fa-user-circle-o"></i>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <a href="#miniCart" class="mini-cart-btn toolbar-btn">
                                            <i class="dl-icon-cart4"></i>
                                            <sup class="mini-cart-count">2</sup>
                                        </a>
                                    </li>
                                    <li class="header-toolbar__item">
                                        <a href="#searchForm" class="search-btn toolbar-btn">
                                            <i class="dl-icon-search1"></i>
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
                        <div class="footer-column-1 mb-md--40">
                            <div class="footer-widget">
                                <h3 class="widget-title widget-title--2">
                                    Customer Service
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
                                    <li><a href="#">ORDER TRACKING</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-column-2  ">
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
                                    <li><a href="#">ORDER TRACKING</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-column-3 mb-xs--40">
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
                        <div class="footer-column-4 mb-xs--40">
                            <div class="footer-widget">
                                <h3 class="widget-title widget-title--2">Contact Info</h3>
                                <ul class="contact-info">
                                    <li class="contact-info__item">
                                        <i class="fa fa-phone"></i>
                                        <span><a href="tel:+919619614785" class="contact-info__link">(+91) 961 9614 785</a></span>
                                    </li>
                                    <li class="contact-info__item">
                                        <i class="fa fa-envelope"></i>
                                        <span><a href="mailto:support@hnilifestyle.com" class="contact-info__link">support@hnilifestyle.com</a></span>
                                    </li>
                                    <li class="contact-info__item">
                                        <i class="fa fa-map-marker"></i>
                                        <span>KHUSHI NATURALS,<br />
                                            Unit no.112, 1st Floor, Bldg no.A6,Harihar Complex, Dapode,Thane- 421302.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-column-5">
                            <div class="footer-widget">
                                <h3 class="widget-title widget-title--2">
                                    Keep Up To Date
                                </h3>
                                <div class="form-widget mb--20">
                                    <form
                                        action="#"
                                        class="newsletter-form newsletter-form--6 mc-form" method="post"
                                        target="_blank">
                                        <input type="email" name="newsletter-email" id="newsletter-email"
                                            class="newsletter-form__input" placeholder="Enter Your Email Address.." required />
                                        <button type="submit" class="newsletter-form__submit">
                                            Subscribe
                                        </button>
                                    </form>
                                </div>
                                <div class="textwidget">
                                    <ul class="social">
                                        <li class="social__item">
                                            <a href="https://www.facebook.com/hnilifestyle" target="_blank" class="social__link" target="_blank"
                                                rel="nofollow noopener noreferrer">
                                                <i class="fa fa-facebook"></i>
                                                <span class="sr-only">Facebook</span>
                                            </a>
                                        </li>
                                        <li class="social__item">
                                            <a href="https://www.instagram.com/hni.lifestyle/" target="_blank" class="social__link" target="_blank"
                                                rel="nofollow noopener noreferrer">
                                                <i class="fa fa-instagram"></i>
                                                <span class="sr-only">Instagram</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="textwidget mt--15">
                                    <img src="{!! asset('assets/img/others/payments.png') !!}" alt="Payment">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom ptb--15">
                    <div class="row">
                        <div class="col-sm-12 text-sm-left text-center">
                            <p class="copyright-text">
                                Copyright © 2019
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
            <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
            <div class="searchform__body">
                <p>Start typing and press Enter to search</p>
                <form class="searchform" action="/search" method="GET">
                    <input name="q" placeholder="Search entire store here ..." type="text"
                        value="{{ Request::get('q') }}" id="search-box1" class="searchform__input" autocomplete="off" />
                    <datalist id="suggestion1">
                        @foreach($keywords as $key)
                        <option value="{{ $key->keyword }}">
                            @endforeach
                        </option>
                    </datalist>

                    <button type="submit" class="searchform__submit">
                        <i class="dl-icon-search10"></i>
                    </button>
                </form>
            </div>
        </div>
        <!-- Search from End -->

        <!-- Side Navigation Start -->
        <aside class="side-navigation" id="sideNav">
            <div class="side-navigation-wrapper">
                <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
                <div class="side-navigation-inner">
                    <div class="widget">
                        <ul class="sidenav-menu">
                            @if(auth('user')->check())
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="fa fa-user-circle-o"></i>
                                    {{ Str::limit(auth('user')->user()->name,8,'') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('user.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile') }}">My Account</a>
                            </li>
                            <li>
                                <a href="{{ route('user.showOrder') }}">Orders</a>
                            </li>

                            <!-- <li><a href="#">Download</a></li> -->
                            <li>
                                <a href="{{
                                            route('user.change-password')
                                        }}">Change Password</a>
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
                <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
                <div class="mini-cart-inner">
                    <h5 class="mini-cart__heading mb--40 mb-lg--30">
                        Shopping Cart
                    </h5>
                    <div class="mini-cart__content">
                        <ul class="mini-cart__list">
                            <li class="mini-cart__product">
                                <a href="#" class="remove-from-cart remove">
                                    <i class="dl-icon-close"></i>
                                </a>
                                <div class="mini-cart__product__image">
                                    <img src="{!! asset('assets/img/products/prod-17-1-70x91.jpg') !!}"
                                        alt="products" />
                                </div>
                                <div class="mini-cart__product__content">
                                    <a class="mini-cart__product__title" href="#">Chain
                                        print bermuda shorts
                                    </a>
                                    <span class="mini-cart__product__quantity">1 x ₹49.00</span>
                                </div>
                            </li>
                            <li class="mini-cart__product">
                                <a href="#" class="remove-from-cart remove">
                                    <i class="dl-icon-close"></i>
                                </a>
                                <div class="mini-cart__product__image">
                                    <img src="{!! asset('assets/img/products/prod-18-1-70x91.jpg') !!}"
                                        alt="products" />
                                </div>
                                <div class="mini-cart__product__content">
                                    <a class="mini-cart__product__title"
                                        href="#">Waxed-effect pleated skirt</a>
                                    <span class="mini-cart__product__quantity">1 x ₹49.00</span>
                                </div>
                            </li>
                            <li class="mini-cart__product">
                                <a href="#" class="remove-from-cart remove">
                                    <i class="dl-icon-close"></i>
                                </a>
                                <div class="mini-cart__product__image">
                                    <img src="{!! asset('assets/img/products/prod-19-1-70x91.jpg') !!}"
                                        alt="products" />
                                </div>
                                <div class="mini-cart__product__content">
                                    <a class="mini-cart__product__title"
                                        href="#">Waxed-effect pleated skirt</a>
                                    <span class="mini-cart__product__quantity">1 x ₹49.00</span>
                                </div>
                            </li>
                        </ul>
                        <div class="mini-cart__total">
                            <span>Subtotal</span>
                            <span class="ammount">₹98.00</span>
                        </div>
                        <div class="mini-cart__buttons">
                            <a href="{{ route('cart') }}" class="btn btn-fullwidth btn-style-1">View Cart</a>
                            <a href="{{ route('checkout') }}" class="btn btn-fullwidth btn-style-1">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Mini Cart End -->

        <!-- Global Overlay Start -->
        <div class="ai-global-overlay"></div>
        <!-- Global Overlay End -->
    </div>
    <!-- Main Wrapper End -->

    <!-- ************************* JS Files ************************* -->

    <!-- jQuery JS -->
    <script src="{!! asset('assets/js/vendor/jquery.min.js') !!}"></script>

    <!-- Bootstrap and Popper Bundle JS -->

    <script src="{!! asset('assets/js/bootstrap.bundle.min.js') !!}"></script>

    <!-- All Plugins Js -->

    <script src="{!! asset('/assets/js/plugins.js') !!}"></script>

    <!-- Ajax Mail Js -->

    <script src="{!! asset('/assets/js/ajax-mail.js') !!}"></script>

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

    <!-- REVOLUTION ACTIVE JS FILES -->

    <script src="{!! asset('assets/js/revoulation.js') !!}"></script>

    @yield('extrajs')
    @if(Session::has('messageSuccess1'))
    <div class="pop-message-body">
        <div class="flex-container">
            <div id="successSnackbar">{{Session::get('messageSuccess1')}}</div>
        </div>
    </div>
    <script>
        $(document).ready(function (e) {
            var x = document.getElementById("successSnackbar");
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "show1");
            }, 5000);
        });

    </script>
    @endif
    @if(Session::has('messageDanger1'))
    <div class="pop-message-body">
        <div class="flex-container">
            <div id="dangerSnackbar">{{Session::get('messageDanger1')}}</div>
        </div>
    </div>
    <script>
        var x = document.getElementById("dangerSnackbar");
        x.className = "show";
        setTimeout(function () {
            x.className = x.className.replace("show", "show1");
        }, 5000);

    </script>
    @endif
    @if($errors->any())
    <div class="pop-message-body">
        <div class="flex-container">
            <ul id="dangerSnackbar">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    <script>
        var x = document.getElementById("dangerSnackbar");
        x.className = "show";
        setTimeout(function () {
            x.className = x.className.replace("show", "show1");
        }, 7000);

    </script>
    @endif

    <script>
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

        $(".form").submit(function () {
            $(".button_update").attr("disabled", "disabled");
            $(".button_update").html("Please Wait");
        });

    </script>
</body>

</html>
